<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use App\Models\Customer;
use PDF;
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF($id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = InvoiceItem::where('invoice_id', $id)->get();
    
    
        $user = User::find($invoice->user_id);
        $customer = Customer::find($invoice->customer_id);
    
        $data = [
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'user' => $user,
            'customer' => $customer,
        ];
    
        $pdf = PDF::loadView('pdf.ExportInvoices', $data);
        // dd($invoice);
    
        return $pdf->stream('itsolutionstuff.pdf');
    }
     

}