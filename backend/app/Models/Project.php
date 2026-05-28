<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'client_name',
        'category',
        'technologies',
        'featured_image',
        'gallery_images',
        'project_url',
        'start_date',
        'end_date',
        'is_featured',
        'is_published',
        'order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery_images' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
