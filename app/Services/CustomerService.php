<?php
namespace App\Services;

use App\Models\Transaction;

class CustomerService
{
    public function getCustomerBalance($customerId) {
        $transactions = Transaction::with('eq_currency')
            ->where('ref_id', $customerId)->where('transaction_type','rasid_bord')->orWhere('transaction_type','order')
            ->get();
        $balances = [];

        foreach ($transactions as $transaction) {
            $currencyName = $transaction->eq_currency->name; // Assuming 'name' is the field in the 'currency' table
            // $amount = $transaction->amount;
            $amount = $transaction->amount_equal;
            $type = $transaction->rasid_bord; // 'credit' or 'debit'

            if (!isset($balances[$currencyName])) {
                $balances[$currencyName] = [
                    'rasid' => 0,
                    'bord' => 0,
                    'balance' => 0,
                ];
            }

            if ($type === 'rasid') {
                $balances[$currencyName]['rasid'] += $amount;
            } elseif ($type === 'bord') {
                $balances[$currencyName]['bord'] += $amount;
            }

            // Calculate balance
            $balances[$currencyName]['balance'] = $balances[$currencyName]['rasid'] - $balances[$currencyName]['bord'];
        }

        ///return response()->json($balances);
        return $balances;
    }
}
