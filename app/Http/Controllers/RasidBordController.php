<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CustomerModel;
use App\Models\FinanceAccount;
use Illuminate\Http\Request;
use App\Services\GenerateCheckNum;
use App\Http\Requests\StoreRasidBordRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RasidBordController extends Controller
{

    protected $genCheckNum;

    public function __construct(GenerateCheckNum $genCheckNum)
    {
        $this->genCheckNum = $genCheckNum;
    }

    public function index(Request $request)
    {
        try {

            $transactions = Transaction::where('status', 1)->where('transaction_type', 'rasid_bord')
                ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])->orderBy('id', 'desc')
                ->paginate(config('pagination.per_page', 10));


            $currencies = Currency::where('status', '1')->get();
            $customers = CustomerModel::where('status', '1')->where('role', 'customer')->get();
            $banks = FinanceAccount::where('account', 'bank')->get();


            if ($transactions->isEmpty() && $currencies->isEmpty() && $customers->isEmpty()) {
                return view('rasid_bord.index', [
                    'transactions' => $transactions,
                    'banks' => $banks,
                    'currencies' => $currencies,
                    'customers' => $customers,
                    'msg' => 'وجود ندارد',

                ]);
            }
            
            // return response()->json($transactions);

            return view('rasid_bord.index', [
                'transactions' => $transactions,
                'banks' => $banks,
                'currencies' => $currencies,
                'customers' => $customers,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(StoreRasidBordRequest $request)
    {

        try {

            DB::beginTransaction();

            // Generate check number
            $check_number = $this->genCheckNum->new_check_number();

            $transaction_values = [
                'rasid_bord' => $request->rasid_bord,
                'transaction_type' => 'rasid_bord',
                'amount' => $request->amount,
                'currency' => $request->currency,
                'finance_acount_id' => 24,
                'bank_acount_id' => $request->bank_id,
                'amount_equal' => $request->amountequal,
                'currency_equal' => $request->currencyequal,
                'currency_rate' => $request->rate,
                'ref_id' => $request->customer, // Use request input or fallback to 1
                'user_id' => Auth::user()->id, 
                'desc' => $request->desc,
                'date' => $request->date,
                'check_number' => $check_number,
            ];


          
            // Insert transaction and get its ID
            $transaction_id = Transaction::insertGetId($transaction_values);

            // dd($transaction_id);

            if ($transaction_id) {
                $output_data = Transaction::where('id', $transaction_id)
                    ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account'])
                    ->first();

                DB::commit();
                return response()->json([
                    'msg' => ' با موفقیت ذخیره شد',
                    'type' => 'success',
                ]);
            } else {
                DB::rollback();
                return response()->json([
                    'msg' => ' با موفقیت انجام نشد',
                    'type' => 'error',
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error("RasidBord storing data",['exception' => $e->getMessage()]);
            return response()->json([
                'msg' => $e->getMessage(),
                'type' => 'error',
            ]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getBanksByCurrency($id)
    {

        try {
            $currency = Currency::where('id', $id)->first();
            $financeAccount = FinanceAccount::where('id', $id)->first();
            $bank_accounts = FinanceAccount::where('currency', $currency->id)->where('account', 'bank')->get();

            if ($bank_accounts->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
            return response()->json(['financeAccCurrencies' => $currency, 'banks' => $bank_accounts]);
        } catch (\Throwable $e) {
            return "Not found" . $e;
        }
    }
}
