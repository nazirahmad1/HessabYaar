<?php

namespace App\Services;

class TransactionTypeService
{
    public static function displayTransactionType($transactionType){
              if ($transactionType === 'rasid_bord') {
            return 'رسید برد ';
        } else if ($transactionType === 'exchange') {
            return 'تبادله  اسعار';
        } else if($transactionType === 'expense') {
            // Handle other types if necessary
            return 'مصارف'; // Fallback to original type
        }else if($transactionType === 'transfer'){
            return 'انتقال بانکی';
        }else if($transactionType === 'commission'){
            return 'کمیشن';
        }else if($transactionType === 'opening_balance'){
            return 'افتتاح حساب';
        }
    }
}












         