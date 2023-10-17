<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ValidateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '12', '14'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
            'items' => 'required|array',
        ];
    }
    
}

