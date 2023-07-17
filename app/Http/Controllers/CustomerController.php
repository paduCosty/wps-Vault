<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(15);
        // dd('test');
        // dd($request->all());
        return response()->json($customers);
    }


    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;  
           
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'vat_number' => 'required',
            'type' => ['required', Rule::in(['individual', 'business'])],
        ]);

        dd(type);
        $validatedData['user_id'] = $user_id;
        $customer = Customer::create($validatedData);
        
        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        $validatedData = request->validate([
            'user_id' => 'required',
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => ['required', 'email', Rule::unique('customers')->ignore($customer)],
            'vat_number' => 'required',
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
