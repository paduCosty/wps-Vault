<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(15);
        return response()->json($invoices);
    }

    public function show(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        return response()->json($invoice);
    }

    public function edit($id)
    {
        $invoices = Invoice::find($id);
        return response()->json($invoices);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
    
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '14', '30'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
        ]);
        // dd($invoices);

        return response()->json($invoice, 200);
      
    }
    
    public function update(Request $request, Invoice $invoice)
    {
        $user_id = Auth::user()->id;
    
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '14', '30'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
        ]);
    
        return response()->json($invoice, 200);
    }
    

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
    }
