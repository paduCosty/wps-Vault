<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

    class CustomerController extends Controller
    {
<<<<<<< HEAD
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
=======
      
        $customers = Customer::paginate(15);
        return response()->json($customers);
    }


    public function show(Request $request, $id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;  
           
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'vat_number' => 'required',
            'type' => 'required',
        ]);
       
        $validatedData['user_id'] = $user_id;

        $customer = Customer::create($validatedData);
        
        return response()->json(['status'=> 200]);
    }


    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'vat_number' => 'required',
            'type' => 'required',
        ]);
        $customer->update($validatedData);
    
        return response()->json($customer, 200);
    }
    

    


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }

}
>>>>>>> Costumers/User
