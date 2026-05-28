<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterLink extends Model
{
    protected $fillable = [
        'footer_section_id',
        'title',
        'url',
        'is_external',
        'open_new_tab',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_external' => 'boolean',
        'open_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(FooterSection::class, 'footer_section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
