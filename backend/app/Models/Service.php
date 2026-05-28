<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'icon',
        'image',
        'features',
        'price',
        'price_label',
        'is_featured',
        'is_active',
        'order',
        'why_need',
        'benefits',
        'workflow',
        'platforms',
        'contact_message',
    ];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'workflow' => 'array',
        'platforms' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
