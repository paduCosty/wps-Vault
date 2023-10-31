<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use App\Models\Customer;
use App\Http\Requests\PDFService;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF(PDFService $pdfService, $id)
    {
        $pdf = $pdfService->generateInvoicePDF($id);

        return $pdf->stream();
    }

}