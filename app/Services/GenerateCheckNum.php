<?php

namespace App\Services;

use App\Models\Transaction;

class GenerateCheckNum
{
    // public static function new_check_number()
    // {
    //     $last = Transaction::orderBy('id', 'desc')->pluck('check_number')->first();

    //     if ($last) {
    //         $number = explode("-", $last);
    //         $new_number = $number[1] + 1;
    //         return 'check_number_' . $new_number;
    //     }

    //     return 'check_number_1';
    // }
// }


public static function new_check_number()
{
    $last = Transaction::orderBy('id', 'desc')->pluck('check_number')->first();

    if ($last) {
        // Ensure check_number contains "-" before exploding
        if (strpos($last, "-") !== false) {
            $number = explode("-", $last);
            $new_number = isset($number[1]) ? ((int) $number[1] + 1) : 1;
        } else {
            // Fallback if format is incorrect
            $new_number = 1;
        }
        return 'check_number-' . $new_number;
    }

    return 'check_number-1';
}



    // public static function new_check_number()
    // {
    //     $last = Transaction::orderBy('id','desc')->pluck('check_number')->first();

    //     $new_check_number='';
    //     if($last){
    //         $number = explode("-",$last);
    //         $new_number  = $number[1]+1;
    //         $new_check_number = 'Hawala-'.$new_number;
    //     }else{
    //         $new_check_number = 'Hawala-1';
    //     }

    //     return $new_check_number;
    

}
  

