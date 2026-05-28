<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'nib',
        'npwp',
        'company_name',
        'category',
        'process_history',
        'terms_summary',
        'privacy_summary',
        'is_active',
    ];

    protected $casts = [
        'process_history' => 'array',
        'terms_summary' => 'array',
        'privacy_summary' => 'array',
        'is_active' => 'boolean',
    ];
}
