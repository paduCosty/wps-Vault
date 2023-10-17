<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\ValidateRequest;


class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(15);
        return response()->json($invoices);
    }


    public function show($id)
    {
        $invoice = Invoice::with('invoiceItems', 'customer', 'user')->find($id);
        return response()->json($invoice);
    }

    
    public function edit($id)
    {
        $invoice = Invoice::with('invoiceItems')->find($id);
        return response()->json($invoice, 200);
    }
    
    
    public function store(ValidateRequest $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'You must be authenticated'], 401);
        }
    
        $validatedData = $request->validated();

        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $validatedData['customer_id'],
            'invoice_number' => $validatedData['invoice_number'],
            'due_date' => $validatedData['due_date'],
            'payment_term' => $validatedData['payment_term'],
            'currency' => $validatedData['currency'],
            'type' => $validatedData['type'],
        ]);
    
        $invoice->invoiceItems()->createMany(
            array_map(
                function ($item) {
                    return [
                        'amount' => $item['amount'] ?? null,
                        'description' => $item['description'] ?? null,
                    ];
                },
                array_filter($validatedData['items'])
            )
        );
        return response()->json($invoice, 200);
    }
    

    public function update(ValidateRequest $request, Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $validatedData = $request->validated();
    
        $invoice->fill($validatedData);
        $invoice->save();
    
        $invoice->invoiceItems()->delete();
        $invoice->invoiceItems()->createMany(
            array_map(
                function ($item) {
                    return [
                        'amount' => $item['amount'] ?? null,
                        'description' => $item['description'] ?? null,
                    ];
                },
                array_filter($validatedData['items'])
            )
        );
    
        return response()->json($invoice, 200);
    }
    
    
    
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
}