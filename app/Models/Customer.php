<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'contact_name',
        'company_name',
        'email',
        'vat_number',
        'status',
        'type',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}