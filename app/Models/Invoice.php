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


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    
    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }

}
