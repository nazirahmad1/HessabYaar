<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'phone' => 'required|unique:customer,phone',
            'email' => 'nullable|email|unique:customer,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dob' => 'nullable|date',
            'tazId' => 'nullable|string|max:255',
            'passId' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'desc' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام ضروری است',
            'phone.required' => 'شماره تماس ضروری است',
            'phone.unique' => 'شماره تماس از قبل موجود است',
            // 'email.required' => 'ایمیل ضروری است',
            'email.unique' => 'ایمیل از قبل موجود است',
        ];
    }
}
