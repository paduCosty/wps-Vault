<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'amount',
        'description',
    ];

    // Relația între InvoiceItem și Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Alte metode și relații
}
