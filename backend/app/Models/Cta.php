<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cta extends Model
{
    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        'is_active',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
