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

    
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
