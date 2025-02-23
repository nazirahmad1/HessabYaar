<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Currency;
use App\Models\FinanceAccount;
use App\Models\IncomeExp;
use App\Models\Transaction;
use App\Services\GenerateCheckNum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use MyTransactionController;
use Illuminate\Support\Facades\Auth;
class ExpenseController extends Controller
{

    protected $genCheckNum;

    public function __construct(GenerateCheckNum $genCheckNum)
    {
        $this->genCheckNum = $genCheckNum;
    }
    public function index(Request $request)
    {
        try {
            // Query expenses instead of FinanceAccount
            $query = IncomeExp::where('status', 1);

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;

                $query->where('id', 'like', "%{$search}%")
                      ->orWhere('date', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%")
                      ->orWhere('amount', 'like', "%{$search}%")
                      ->orWhereHas('expense_acount', function ($q) use ($search) {
                          $q->where('account_name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('expense_bank', function ($q) use ($search) {
                          $q->where('account_name', 'like', "%{$search}%");
                      });
            }

            $expenses = $query->orderBy('id', 'desc')->paginate(config('pagination.per_page', 10));

            $financeAccounts = FinanceAccount::where('status', 1)
                                             ->where('account', 'expense')
                                             ->orderBy('id', 'desc')
                                             ->get();

            $currencies = Currency::where('status', 1)->get();
            $banks = FinanceAccount::where('account', 'bank')->get();

            return view('expense.index', compact('financeAccounts', 'expenses', 'currencies', 'banks'));

        } catch (\Exception $e) {
            Log::error('Error fetching new expense: ', ['exception' => $e->getMessage()]);

            return view('expense.index', compact('financeAccounts', 'expenses', 'currencies', 'banks'))
                ->with('msg', 'An error occurred: ' . $e->getMessage())
                ->with('type', 'error');
        }
    }

    public function getFinanceAccountByCurrencyId($id)
    {
        $financeAccount = FinanceAccount::where('id',$id)->first();
        $currency = Currency::where('id',$financeAccount->currency)->first();
        // dd($financeAccount);
        $bank_acounts = FinanceAccount::where('currency',$currency->id)->where('account','bank')->get();

            return response()->json(['financeAccCurrencies'=>$currency,'banks'=>$bank_acounts]);


    }


    public function store(StoreExpenseRequest $request) {
        try {
            DB::beginTransaction();

            // Generate check number
            $check_number = $this->genCheckNum->new_check_number();

            // Find the finance account
            $expense_account = FinanceAccount::where('id', $request->financeAccount)->first();

            $incomeExp_values = [
                'type' => 'expense',
                'amount' => $request->amount,
                'currency' => $expense_account->currency,
                'amount_equal' => $request->amount,
                'currency_equal' => $expense_account->currency,
                'date' => $request->date,
                'finance_acount_id' => $expense_account->id,
                'bank_id' => $request->bank_id,
                // 'user_id' => 2, // Replace with Auth::user()->id for dynamic user assignment
                'user_id' => Auth::user()->id, // Replace with Auth::user()->id for dynamic user assignment
                'state' => 'payed',
                'ref_type' => 'expense',
                'desc' => $request->desc,
            ];

            $expense_id = IncomeExp::insertGetId($incomeExp_values);

            $transaction_values = [
                'rasid_bord' => 'bord',
                'transaction_type' => 'expense',
                'amount' => $request->amount,
                'currency' => $expense_account->currency,
                'ref_id' => $expense_id,
                'finance_acount_id' => $expense_account->id,
                'bank_acount_id' => $request->bank_id,
                // 'user_id' => 2, // Replace with Auth::user()->id for dynamic user assignment
                'user_id' => Auth::user()->id, // Replace with Auth::user()->id for dynamic user assignment
                'amount_equal' => $request->amount,
                'currency_equal' => $expense_account->currency,
                'desc' => $request->desc,
                'date' => $request->date,
                'check_number' => $check_number,
            ];

            $transaction_id = Transaction::insertGetId($transaction_values);

            if ($transaction_id && $expense_id) {
                // Update IncomeExp with transaction ID
                IncomeExp::where('id', $expense_id)->update(['transaction_id' => $transaction_id]);

                // Fetch the newly created expense with related data
                $output_data = IncomeExp::where('id', $expense_id)
                    ->with(['expense_currency', 'inserted_by_user', 'expense_acount', 'expense_bank'])
                    ->first();

                DB::commit();

                // Pass required data to the view
                $financeAccounts = FinanceAccount::where('status', '='
                , '1')->where('account','expense')->orderBy('id', 'desc')->get();
                $currencies = Currency::where('status',1);
                $banks = FinanceAccount::where('account','bank')->get();

                return response()->json([
                    'msg' => 'مصرف جدید با موفقیت ذخیره شد',
                    'type' => 'success',
                ]);


            } else {
                DB::rollback();

                return response()->json([
                    'msg' => 'مصرف جدید با موفقیت ذخیره نشد: ',
                    'status' => 'false',
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error('Error storing  new expense: ', ['exception' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
