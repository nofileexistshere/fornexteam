<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'category',
        'tags',
        'preview_image',
        'screenshots',
        'price',
        'demo_url',
        'download_url',
        'version',
        'features',
        'is_featured',
        'is_published',
        'downloads',
        'order',
    ];

    protected $casts = [
        'tags' => 'array',
        'screenshots' => 'array',
        'price' => 'decimal:2',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
