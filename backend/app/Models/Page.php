<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_description',
        'image',
        'is_published',
        'order',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
