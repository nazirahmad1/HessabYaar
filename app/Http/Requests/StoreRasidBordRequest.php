<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRasidBordRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         "rasid_bord"=>"required",
    //         "customer"=>"required",
    //         "currency"=>"required",
    //         "currencyequal"=>"required",
    //         "amount"=>"required",
    //         "amountequal"=>"required",
    //         "date"=>"required",
    //         "rate"=>"required",
    //         "bank_id"=>"required|max:2|exists:finance_account,id",
    //         "desc"=>"required|string|max:300",
    //         // 'ref_id' => 'nullable|integer',
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'rasid_bord.required'=>'رسیدوبرد را انتخاب کنید.',
    //         'customer.required'=>'مشتری را انتخاب کنید',
    //         'currency.required'=>'واحد پولی را انتخاب کنید.',
    //         'currencyequal.required'=>'واحد پولی معادل را انتخاب کنید.',
    //         'bank_id.required'=>'دخل را انتخاب کنید.',
    //         'bank_id.exists'=>'دخل معتبر نیست',
    //         'amount.required'=>'مبلغ را وارد کنید.',
    //         'amount.max'=>'تعداد ارقام باید کمتر از 10 باشد',
    //         'amountequal.required'=>'مبلغ معادل را وارد کنید.',
    //         'amountequal.max'=>'تعداد ارقام باید کمتر از 10 باشد',
    //         'rate.required'=>'نرخ ارز ضروری میباشد',
    //         'date.required'=>'تاریخ را وارد کنید',
    //         'date.max'=>'تاریخ معتبر نیست',
    //         'desc.required'=>'توضیحات را وارد کنید',
    //         'desc.max'=>'توضیحات نباید بیشتر از 300 حرف باشد',
    //     ];
    // }
    
    public function rules(): array
{
    return [
        'rasid_bord' => 'required|string',
        'customer' => 'required|integer', // Assuming you have a customers table
        'currency' => 'required|string',
        'currencyequal' => 'required|string', // Consistent naming
        'amount' => 'required|numeric|max:999999', // Max value to allow up to 9 digits
        'amountequal' => 'required|numeric|max:999999',
        'date' => 'required|date',
        'rate' => 'required|numeric|min:0', // Ensure a valid rate
        'bank_id' => 'required|integer|exists:finance_account,id', // Validate as an existing finance account
        'desc' => 'nullable|string|max:300', // Optional description
        'ref_id' => 'nullable|integer', // Optional reference ID
    ];
}

public function messages()
{
    return [
        'rasid_bord.required' => 'رسیدوبرد را انتخاب کنید.',
        'customer.required' => 'مشتری را انتخاب کنید.',
        'currency.required' => 'واحد پولی را انتخاب کنید.',
        'currencyequal.required' => 'واحد پولی معادل را انتخاب کنید.',
        'amount.required' => 'مبلغ را وارد کنید.',
        'amount.numeric' => 'مبلغ باید عددی باشد.',
        'amount.max' => 'مبلغ نمی‌تواند بیشتر از 9 رقم باشد.',
        'amountequal.required' => 'مبلغ معادل را وارد کنید.',
        'amountequal.numeric' => 'مبلغ معادل باید عددی باشد.',
        'amountequal.max' => 'مبلغ معادل نمی‌تواند بیشتر از 9 رقم باشد.',
        'date.required' => 'تاریخ را وارد کنید.',
        'date.date' => 'تاریخ معتبر نمی‌باشد.',
        'rate.required' => 'نرخ ارز ضروری می‌باشد.',
        'rate.numeric' => 'نرخ ارز باید عددی باشد.',
        'rate.min' => 'نرخ ارز نمی‌تواند کمتر از 0 باشد.',
        'bank_id.required' => 'دخل را انتخاب کنید.',
        'bank_id.exists' => 'دخل انتخاب‌شده معتبر نمی‌باشد.',
        'desc.max' => 'توضیحات نباید بیشتر از 300 حرف باشد.',
    ];
}

}
