<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'chat_admin_name',
        'chat_hours',
        'address_title',
        'address_line1',
        'address_line2',
        'map_embed_url',
        'map_latitude',
        'map_longitude',
        'tiktok_url',
        'instagram_url',
        'linkedin_url',
        'is_active',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'is_active' => 'boolean',
        'map_latitude' => 'float',
        'map_longitude' => 'float',
    ];
}
