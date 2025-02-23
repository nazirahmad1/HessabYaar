<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
{
    return [
        'rasid_bord'=>'required|in:rasid,bord',
            'amount'=>'required',
            'currency'=>'required',
            'amount_equal'=>'required',
            'currency_equal'=>'required',
            'currency_rate'=>'required',
            'ref_id'=>"required|max:20|exists:users,id",
            'bank_acount_id'=>'required',
            'desc'=>'nullable'// Optional reference ID
    ];
}

public function messages()
{
    return [
        'rasid_bord.required'=>'رسید و برداشت ضروری میباشد',
        'amount.required'=>'مبلغ ضروری میباشد',
        'currency.required'=>'واحد ضروری میباشد',
        'amount_equal.required'=>'مبلغ معادل ضروری میباشد',
        'currency_equal.required'=>'واحد معادل ضروری میباشد',
        'currency_rate.required'=>'نرخ ضروری میباشد',
        'ref_id.required'=>'ریفرینس آیدی ضروری میباشد',
        'bank_acount_id.required'=>'آیدی حساب بانکی ضروری میباشد',
    ];
}
}
