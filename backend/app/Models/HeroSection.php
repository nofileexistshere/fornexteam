<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text',
        'heading',
        'description',
        'image_light',
        'image_dark',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'show_secondary_button',
        'is_active',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'show_secondary_button' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
