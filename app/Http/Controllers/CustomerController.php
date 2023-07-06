<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(15);
        return response()->json($customers);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'vat_number' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'type' => ['required', Rule::in(['individual', 'business'])],
        ]);

        $customer = Customer::create($validatedData);

        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => ['required', 'email', Rule::unique('customers')->ignore($customer)],
            'vat_number' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'type' => ['required', Rule::in(['individual', 'business'])],
        ]);

        $customer->update($validatedData);

        return response()->json($customer, 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}
