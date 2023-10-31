<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateCustomer extends FormRequest
{
            
    public static function rules(): array
    {
        return [
            'contact_name' => ['required','string'],
            'company_name' => ['required','string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'vat_number' => ['required', 'regex:/^[0-9A-Za-z]*$/'],
            'type' => ['required', Rule::in(['Business', 'Individual'])],
        ];
    }

    public function messages()
    {
        return [
            'contact_name.required' => 'The contact name is required.',
            'company_name.required' => 'The company name is required.',
            'email.required' => 'The email address is required.',
            'email.unique' => 'The email address must be unique and not already in use.',
            'vat_number.regex' => 'The VAT Number must contain only letters and numbers.',
            'type.in' => 'Select type (Business or Individual).',

        ];
    }
}
