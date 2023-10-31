<html>
<h1 class="Invoice top-header">Invoice</h1>
<div class="invoice-border">
    <div class="invoice-show">
        <label class="INum">Invoice Number--{{ $invoice->invoice_number }}</label>
        <div class="container mt-4">
            <form class="form">
                <div class="row mb-3">
                    <div class="col-md-4 right">
                        <label class="UBus form-label">Business Name:</label>
                        <div class="UBus1 form-control">{{ $invoice->user ? $invoice->user->business_name : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-4 right">
                        <label class="UVat">Vat Number:</label>
                        <div class="UVat1 form-control">{{ $invoice->user ? $invoice->user->vat_number : 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="UAdr form-label">Address:</label>
                        <div class="UAdr1 form-control">{{ $invoice->user ? $invoice->user->address : 'N/A' }}</div>
                    </div>
                    <div class="col-md-4 right">
                        <label class="UCon form-label">Contact Name:</label>
                        <div class="UCon1 form-control">{{ $invoice->user ? $invoice->user->contact_name : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="UEmail form-label">E-mail:</label>
                        <div class="UEmail1 form-control">{{ $invoice->user ? $invoice->user->email : 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="Cos form-label">Customer Name:</label>
                        <div class="Cos1 form-control">
                            {{ $invoice->customer ? $invoice->customer->contact_name : 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="Com form-label">Company Name:</label>
                        <div class="Com1 form-control">
                            {{ $invoice->customer ? $invoice->customer->company_name : 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="Vat form-label">Vat Number:</label>
                        <div class="Vat1 form-control">{{ $invoice->customer ? $invoice->customer->vat_number : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="Email form-label">Email:</label>
                        <div class="Email1 form-control">{{ $invoice->customer ? $invoice->customer->email : 'N/A' }}
                        </div>
                    </div>
                    <div class="Due1">
                        <label class="form-label">Due Date:</label>
                        <div class="form-control">{{ $invoice->due_date }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
                <div class="invoice-details">
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice_items as $index => $item)
                                <tr>
                                    <td class="item-number">{{ $index + 1 }}.</td>
                                    <td class="item-type">
                                        <div class="form-label">{{ $invoice->type }}</div>
                                    </td>
                                    <td class="item-currency">
                                        <div class="form-label">{{ $invoice->currency }}</div>
                                    </td>
                                    <td class="item-amount">
                                        <div class="form-label">{{ $item->amount }}</div>
                                    </td>
                                    <td class="item-description">
                                        <div class="form-label">{{ $item->description }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="total-amount">Total Amount => {{ $totalAmount }} {{ $invoice->currency }}</td>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

</html>

<style>
    /* Show Invoices */
    .invoice-show {
        max-width: 620px;
        height: 60px;
        width: 700px;
        padding: 40px;
        border: 3.5px solid #080606;
        border-radius: 20px;
        background-color: #fcfafa;
        margin-top: -15px;
        margin-left: -3px;
    }


    .Invoice {
        /*Title Invoice  */
        margin-top: 10;
        position: absolute;
        margin-left: 290px;
        font-size: 40px;
    }

    .UBus {
        /* User Business name */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -54px;
        margin-left: 410px;
    }

    .UBus1 {
        /* User Business name */
        position: relative;
        font-size: 15px;
        top: -73px;
        margin-left: 530px;
    }

    .UVat {
        /* User Vat Number */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -65px;
        margin-left: 410px;
    }

    .UVat1 {
        /* User Vat Number */
        position: relative;
        font-size: 15px;
        top: -83px;
        margin-left: 505px;
    }

    .UAdr {
        /* User Adress */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -76px;
        margin-left: 410px;
    }

    .UAdr1 {
        /* User Adress */
        position: absolute;
        white-space: nowrap;
        font-size: 15px;
        top: 47px;
        margin-left: 1px;
    }

    .UCon {
        /* User Contact Name */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -70px;
        margin-left: 409px;
    }

    .UCon1 {
        /* User Contact Name */
        position: absolute;
        white-space: nowrap;
        font-size: 15px;
        top: 72px;
        margin-left: -0px;
    }

    .UEmail {
        /* User Email */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -65px;
        margin-left: 410px;
    }

    .UEmail1 {
        /* User Email */
        position: relative;
        font-size: 15px;
        top: -83px;
        margin-left: 464px;
    }

    .Cos {
        /* User Email */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -207px;
        margin-left: -32px;
    }

    .Cos1 {
        /* User Email */
        position: relative;
        font-size: 15px;
        top: -225px;
        margin-left: 93px;
    }

    .Com {
        /* User Email */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -218px;
        margin-left: -33px;
    }


    .Com1 {
        /* User Email */
        position: relative;
        font-size: 15px;
        top: -236px;
        margin-left: 91px;
    }

    .Vat {
        /* Vat Number Customer */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -230px;
        margin-left: -32px;
    }

    .Vat1 {
        /* Vat Number Customer */
        position: relative;
        font-size: 15px;
        top: -248px;
        margin-left: 63px;
    }

    .Email {
        /* E-mail Customer */
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 16px;
        top: -242px;
        margin-left: -30px;
    }

    .Email1 {
        /* E-mail Customer */
        position: relative;
        font-size: 14px;
        top: -260px;
        margin-left: 17px;
    }

    .Due1 {
        /* Due Date Customr */
        position: relative;
        top: -259px;
        margin-left: 240px;
    }

    .INum {
        position: relative;
        top: 40px;
        margin-left: 220px;
    }

    .INum1 {
        position: relative;
        margin-top: 200;
        margin-left: 410px;
    }



    .invoice-details {
        border: 3px solid #080606;
        border-radius: 20px;
        padding: 20px;
        width: 658px;
        max-width: none;
        position: relative;
        top: -247px;
        margin-left: -41px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: left;
    }

    .item-type {
        margin-left: 20px;
    }
</style>
