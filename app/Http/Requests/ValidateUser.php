<?php

namespace App\Http\Validators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserValidator
{
    public function validate(): array
    {
        return [
            'contact_name' => ['required', 'unique:users,contact_name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'address' => ['required', 'unique:users,address'],
            'business_name'  => ['required', 'unique:users,business_name'],
            'vat_number' => ['required', 'unique:users,vat_number']
        ];
    }


    public function messages()
    {
        return [
            'contact_name.required' => 'The Contact Name is required.',
            'email.required' => 'The E-mail is required.',
            'email.unique' => 'The E-mail must be unique.',
            'phone.required' => 'The Phone is required.',
            'phone.unique' => 'The Phone must be unique.',
            'address.required' => 'The Address is required.',
            'business_name.unique' => 'Please select a valid type (Business or Individual).',
            'vat_number.regex' => 'The VAT Number is required and should match a specific pattern.',
        ];
    }
}