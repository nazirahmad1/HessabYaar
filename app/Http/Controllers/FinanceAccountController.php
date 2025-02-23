<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinanceAccountsRequest;
use App\Models\Currency;
use App\Models\FinanceAccount;
use App\Models\IncomeExp;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;
use App\Services\GenerateCheckNum;

class FinanceAccountController extends Controller
{
    protected $genCheckNum;

    public function __construct(GenerateCheckNum $genCheckNum)
    {
        $this->genCheckNum = $genCheckNum;
    }

    /**
     * Display a listing of finance accounts with currencies.
     */
    public function index(Request $request)
    {
        try {
            // Paginate currency
            $query = FinanceAccount::query(); 
           
            $currencies = Currency::where('status', 1)->get();

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('id', 'like', "%{$search}%")
                      ->orWhere('account_name', 'like', "%{$search}%")
                      ->orWhere('currency', 'like', "%{$search}%")
                      ->orWhere('account', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%")->with(['finance_currency']);
            }


            $financeAccounts = $query->with(['finance_currency'])->orderBy('id', 'desc')
            ->paginate(config('pagination.per_page', 10));
                
            // return response()->json($financeAccounts);

            if ($financeAccounts->isEmpty()) {
                throw new \Exception(" حساب فایننس   وجود ندارد!");
            }
    
            // Return view with currn$currency
            return view('finance_accounts.index', ['financeAccounts' => $financeAccounts,
            'currencies'=>$currencies]);
    
        } catch (\Throwable $e) {
            Log::error('Error fetching finance accounts: ', ['exception' => $e->getMessage()]);
            // Return view with error message
            return view('finance_accounts.index', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of expenses with pagination.
     */
   

    public function store(StoreFinanceAccountsRequest $request)
{

    $checkNum = $this->genCheckNum->new_check_number();
    $formattedDate = Jalalian::now()->format('Y-m-d');

    DB::beginTransaction();
    try {
        // Creating the finance account
        $financeAccount = FinanceAccount::create([
            'account_name' => $request->account_name,
            'type' => $request->account_type,  
            'currency' => $request->currency,
            'description' => $request->desc,  
            'account' => $request->account,  
            'user_id' => Auth::user()->id,  
        ]);

        $financeAccounts = FinanceAccount::where('status', 1)
        ->with(['finance_currency'])
        ->orderBy('id', 'desc')
        ->paginate(config('pagination.per_page', 10));
        $currencies = Currency::where('status', 1)->get();

        // dd($financeAccount);
        // Creating the transaction related to the finance account
        $transaction = Transaction::create([
            'rasid_bord' => 'rasid',
            'transaction_type' => 'opening_balance',
            'amount' => $request->firstAsset,
            'currency' => $request->currency,
            // 'finance_acount_id' => $financeAccount->id,
            'finance_acount_id' => 38,
            'bank_acount_id' => $financeAccount->id,
            // 'amount_equal' => $request->amount_equal,
            'amount_equal' => 0,
            // 'currency_equal' => $request->currency_equal,
            'currency_equal' => $request->currency,
            'currency_rate' => 1,
            'ref_id'=>0,
            'user_id' => Auth::user()->id,
            'desc' => $request->desc,
            'date' => $formattedDate,
            'check_number' => $checkNum,
        ]);

        // Committing the transaction
        DB::commit();

        return response()->json([
            'msg' => 'حساب با موفقیت ذخیره شد',
            'type' => 'success',
            'account'=>$financeAccount,
             'financeAccounts' => $financeAccounts,
             'currencies' => $currencies,
        ]);
    } catch (\Exception $e) {
        // Rolling back the transaction if an error occurs
        DB::rollBack();
        Log::error('Error storing finance account: ', [
            'exception' => $e->getMessage(),
            'data' => $request->all(),  // Log the request data for debugging
        ]);
        return response()->json([
            'msg' => 'خطا هنگام ذخیره حساب: ' . $e->getMessage(),
            'type' => 'error',
        ]);
    }
}

    /**
     * Show a specific finance account.
     */


    /**
     * Update the specified finance account.
     */


    /**
     * Soft delete the specified finance account.
     */

    /**
     * Search finance accounts based on query parameters.
     */

    /**
     * Filter finance accounts based on type and account.
     */ 
}
