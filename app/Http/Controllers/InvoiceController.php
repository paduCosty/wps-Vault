<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(15);
        return response()->json($invoices);
    }

    public function show(Invoice $invoice)
    {
        return response()->json($invoice);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'customer_id' => 'required',
            'invoice_item_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '12', '14'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
            'status' => ['required', Rule::in(['sent', 'pending', 'paid', 'unpaid'])],
        ]);

        $invoice = Invoice::create($validatedData);

        return response()->json($invoice, 201);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'customer_id' => 'required',
            'invoice_item_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '12', '14'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
            'status' => ['required', Rule::in(['sent', 'pending', 'paid', 'unpaid'])],
        ]);

        $invoice->update($validatedData);

        return response()->json($invoice, 200);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
}
