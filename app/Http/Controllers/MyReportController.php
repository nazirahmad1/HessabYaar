<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use App\Models\BankBalance;
use App\Models\Currency;
use App\Models\FinanceAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class MyReportController extends Controller
{



       public function getBankBalance(Request $request){

        try {


       $bankBalance = BankBalance::paginate(config('pagination.per_page'));
       $currency_count= Currency::where('status',1)->count();
       $financeAcc_count= FinanceAccount::where('status',1)->count();
       $allbalances = $this->getAllBalances();
       if($bankBalance->isEmpty()){
           return response()->json([]);
       }


    return view('reports.index', [
                    'currency_counts' => $currency_count,
                    'financeAcc_count' => $financeAcc_count,
                    'bank_balance' => $bankBalance,
                    'allbalances'=>$allbalances
                ]);

    } catch (\Throwable $e) {
       return response()->json(['message'=>$e->getMessage()]);
    }
   }

   public function getAllBalances() {
    $transactions = Transaction::select('currency', 'rasid_bord', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('currency', 'rasid_bord')
        ->with('tr_currency') // Assuming the relationship name is tr_currency
        ->get();

    $balances = [];

    foreach ($transactions as $transaction) {
        $currencyName = $transaction->tr_currency->name; // Accessing the currency name through the relationship

        $rasidBord = $transaction->rasid_bord;
        if (!isset($balances[$currencyName])) {
            $balances[$currencyName] = [
                'currency' => $currencyName,
                'rasid' => 0,
                'bord' => 0,
                'balance' => 0
            ];
        }

        if ($rasidBord === 'rasid') {
            $balances[$currencyName]['rasid'] += $transaction->total_amount;
        } elseif ($rasidBord === 'bord') {
            $balances[$currencyName]['bord'] += $transaction->total_amount;
        }
    }

    foreach ($balances as &$balance) {
        $balance['balance'] = $balance['rasid'] - $balance['bord'];
    }

    // return array_values($balances);
    return array_values($balances);
    }


   





public function getBanksTransaction(Request $request)
{
    try {
        // Validate request
        // $request->validate([
        //     'id' => 'required|integer|exists:bank_accounts,id'
        // ]);

        $id = $request->id;

        // Fetch transactions
        $transactions = Transaction::where('bank_account_id', $id)
            ->where('status', 1)
            ->with(['financeAccount', 'customer', 'tr_currency', 'bank_account', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(config('pagination.per_page', 10));

        return view('reports.bankdetails', ['transactions' => $transactions, 'id' => $id]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
}


    public function showcharts(Request $request){
    try {
        $bankBalance = BankBalance::paginate(config('pagination.per_page'));
        $currency_count = Currency::where('status', 1)->count();
        $financeAcc_count = FinanceAccount::where('status', 1)->count();
        $allbalances = $this->getAllBalances();

        if ($bankBalance->isEmpty()) {
            return response()->json([]);
        }

        // Prepare data for charts
        $labels = [];
        $rasidData = [];
        $bordData = [];
        $balanceData = [];

        foreach ($allbalances as $balance) {
            $labels[] = $balance['currency'];
            $rasidData[] = $balance['rasid'];
            $bordData[] = $balance['bord'];
            $balanceData[] = $balance['balance'];
        }

        return view('reports.reportcharts', [
            'currency_counts' => $currency_count,
            'financeAcc_count' => $financeAcc_count,
            'bank_balance' => $bankBalance,
            'allbalances' => $allbalances,
            'chartData' => [
                'labels' => $labels,
                'rasidData' => $rasidData,
                'bordData' => $bordData,
                'balanceData' => $balanceData,
            ],
        ]);

    } catch (\Throwable $e) {
        return response()->json(['message' => $e->getMessage()]);
    }

    }

}
