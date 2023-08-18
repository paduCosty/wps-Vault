<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
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
    public function invoiceItem()
    {
        return $this->hasOne(InvoiceItem::class);
    }



    public function show(Request $request, $id)
    {
        $invoice = Invoice::find($id)->with('invoiceItem');
        
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

        // Create the main invoice
        $invoice = Invoice::create([
            'user_id' => $user_id,
            'customer_id' => $validatedData['customer_id'],
            'invoice_number' => $validatedData['invoice_number'],
            'due_date' => $validatedData['due_date'],
            'payment_term' => $validatedData['payment_term'],
            'currency' => $validatedData['currency'],
            'type' => $validatedData['type'],
        ]);

        if ($request->has('items')) {
            foreach ($request->input('items') as $item) {
                $invoice->invoiceItem()->create([
                    'invoice_id' => $invoice->id,
                    'amount' => isset($item['amount']) ? $item['amount'] : null,
                    'description' => isset($item['description']) ? $item['description'] : null,
                ]);
            }
        }

        if ($request->has('itens')) {
            foreach ($request->input('itens') as $iten) {
                $invoice->invoiceItem()->create([
                    'invoice_id' => $invoice->id,
                    'description' => $iten['description'],
                ]);
            }
        }
        dd($request->all());

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
            'items' => 'required|array', 
            'items.*.amount' => 'sometimes|nullable',
            'items.*.description' => 'sometimes|nullable', 
        ]);

        if ($invoice->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $invoice->update([
            'user_id' => $user_id,
            'customer_id' => $validatedData['customer_id'],
            'invoice_number' => $validatedData['invoice_number'],
            'due_date' => $validatedData['due_date'],
            'payment_term' => $validatedData['payment_term'],
            'currency' => $validatedData['currency'],
            'type' => $validatedData['type'],
        ]);

        if ($request->has('items')) {
            foreach ($request->input('items') as $item) {
                $invoice->invoiceItems()->create([
                    'invoice_id' => $invoice->id,
                    'amount' => isset($item['amount']) ? $item['amount'] : null,
                    'description' => isset($item['description']) ? $item['description'] : null,
                ]);
            }
        }

        if ($request->has('itens')) {
            foreach ($request->input('itens') as $iten) {
                $invoice->invoiceItem()->create([
                    'invoice_id' => $invoice->id,
                    'description' => $iten['description'],
                ]);
            }
        }
        return response()->json($invoice, 200);
    }



    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
    
}
