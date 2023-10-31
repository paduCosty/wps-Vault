<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use App\Models\Customer;
use PDF;


class PDFService extends FormRequest
{
    public function generateInvoicePDF($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            // Return false or throw an exception to handle the situation in the controller
            return false;
        }

        $invoice_items = InvoiceItem::where('invoice_id', $id)->get();
        $user = User::find($invoice->userId);
        $customer = Customer::find($invoice->customerId);

        $totalAmount = 0;
        foreach ($invoice_items as $item) {
                $totalAmount += $item->amount; 
            }

        $data = [
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'user' => $user,
            'customer' => $customer,
            'totalAmount' => $totalAmount,
        ];

        $pdf = PDF::loadView('pdf.ExportInvoices', $data);

        return $pdf;
    }
}











// $invoice = Invoice::find($id);
// $invoice_items = InvoiceItem::where('invoice_id', $id)->get();

// $user = User::find($invoice->user_id);
// $customer = Customer::find($invoice->customer_id);

// $totalAmount = 0; 

// foreach ($invoice_items as $item) {
//     $totalAmount += $item->amount; 
// }

// $data = [
//     'invoice' => $invoice,
//     'invoice_items' => $invoice_items,
//     'user' => $user,
//     'customer' => $customer,
//     'totalAmount' => $totalAmount,
// ];

// $pdf = PDF::loadView('pdf.ExportInvoices', $data);