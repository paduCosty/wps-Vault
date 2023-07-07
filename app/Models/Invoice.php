<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'invoice_item_id',
        'invoice_number',
        'due_date',
        'payment_term',
        'currency',
        'type',
        'status',
    ];

    // Relația între Invoice și User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relația între Invoice și Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relația între Invoice și InvoiceItem
    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }

    // Alte metode și relații
}
