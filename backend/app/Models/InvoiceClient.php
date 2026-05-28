<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceClient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];
}
