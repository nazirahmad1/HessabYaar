<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinanceAccountsRequest extends FormRequest
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
            'account_name' => 'required|string|max:255',
            'type' => 'in:asset,equity,liablity',
            // 'type' => 'required',
            'currency' => 'required',
            'account' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'account_name.required' => 'نام حساب ضروری است',
            'type.in' => 'یکی را انتخاب نمائید',
            'currency.required' => 'واحد پولی ضروری است',
            'account.required' => 'انتخاب حساب ضروری است',
        ];
    }
}
