<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            "financeAccount"=>"required|max:2|exists:finance_account,id",
            "amount"=>"required|max:10",
            "currency"=>"required",
            "date"=>"required|string|max:15",
            "bank_id"=>"required|max:2|exists:finance_account,id",
            "desc"=>"required|string|max:300"
        ];
    }

    public function messages()
    {
        return [
            'financeAccount.required'=>'حساب را انتخاب کنید.',
            'financeAccount.exists'=>'حساب معتبر نیست',
            'currency.required'=>'واحد پولی را انتخاب کنید.',
            'bank_id.required'=>'دخل را انتخاب کنید.',
            'bank_id.exists'=>'دخل معتبر نیست',
            'amount.required'=>'مبلغ را وارد کنید.',
            'amount.max'=>'تعداد ارقام باید کمتر از 10 باشد',
            'date.required'=>'تاریخ را وارد کنید',
            'date.max'=>'تاریخ معتبر نیست',
            'desc.required'=>'توضیحات را وارد کنید',
            'desc.max'=>'توضیحات نباید بیشتر از 300 حرف باشد',
        ];
    }
}
