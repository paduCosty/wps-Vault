<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Dompdf\Dompdf;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;


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
    
    
    public function store(Request $request)
    {
        if(Auth::check()) {
            $user_id = Auth::user()->id;

            $validatedData = $request->validate([
                'customer_id' => 'required',
                'invoice_number' => 'required',
                'due_date' => 'required|date',
                'payment_term' => ['required', Rule::in(['7', '12', '14'])],
                'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
                'type' => ['required', Rule::in(['general'])],
                'items' => [
                    'required',
                    'array',
                    function ($attribute, $value, $fail) {
                        foreach ($value as $item) {
                            if (!isset($item['amount']) || !isset($item['description']) || empty($item['amount']) || empty($item['description'])) {
                                $fail('Items array must have at least one valid element.');
                                break;
                            }
                        }
                    },
                ],
                'items.*.amount' => 'required|numeric',
                'items.*.description' => 'required|string',
                
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
                        'amount' => $item['amount'] ?? '0',
                        'description' => $item['description'] ?? '0',
                    ]);
                }
                dd($validatedData);
            }
            
            return response()->json($invoice, 200);
        }
        return response()->json(['status' => false , 'message', 'You must be authenticated']);
    }


    public function update(Request $request, Invoice $invoice)
    {
        $user_id = Auth::user()->id;
    
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required|date',
            'payment_term' => ['required', Rule::in(['7', '12', '14'])],
            'currency' => ['required', Rule::in(['ron', 'eur', 'usd'])],
            'type' => ['required', Rule::in(['general'])],
            'items' => 'required|array',
            'items.*.amount' => 'sometimes|nullable',
            'items.*.description' => 'sometimes|nullable',
        ]);
    
        if ($invoice->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $invoice->fill([
            'user_id' => $user_id,
            'customer_id' => $validatedData['customer_id'],
            'invoice_number' => $validatedData['invoice_number'],
            'due_date' => $validatedData['due_date'],
            'payment_term' => $validatedData['payment_term'],
            'currency' => $validatedData['currency'],
            'type' => $validatedData['type'],
        ]);
    
        $invoice->save();
    
        
        if ($request->has('items')) {
            $invoice->invoiceItems()->delete(); 
    
            foreach ($request->input('items') as $item) {
                $invoice->invoiceItems()->create([
                    'amount' => $item['amount'] ?? null,
                    'description' => $item['description'] ?? null,
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

   public function InvoicePDF($id)
    {
        try {
            $invoice = Invoice::with('invoiceItems', 'customer', 'user', 'invoiceItems')->find($id);

            $pdf = PDF::loadView('invoices.pdf', ['invoice' => $invoice]);

            // Generează conținutul PDF în memorie
            $pdfContent = $pdf->output();

            // Setează antetul pentru descărcare
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=invoice.pdf', // Pentru a deschide în browser
                // Sau poți utiliza 'attachment' în loc de 'inline' pentru a forța descărcarea
            ];

            return response($pdfContent, 200, $headers);
        } catch (Exception $e) {
            return response('Error generating PDF', 500);
        }
    }
    public function downloadPDF($id)
    {
        $users = User::get();
        $invoiceItems = InvoiceItem::get();
        $invoice = Invoice::with('invoiceItems', 'customer', 'user')->find($id);

        $data = [
            'invoice' => $invoice,
            'users' => $users,
            'invoiceItems' => $invoiceItems,
        ];

        $pdf = PDF::loadView('invoices.pdf', $data);

        return $pdf->download('Invoice.pdf');
    }

    
}