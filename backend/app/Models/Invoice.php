<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'items',
        'subtotal',
        'tax',
        'discount',
        'total',
        'status',
        'issue_date',
        'due_date',
        'paid_date',
        'notes',
        'terms',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(InvoiceClient::class, 'client_id');
    }
}
