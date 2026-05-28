<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InternalProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'status',
        'priority',
        'assigned_to',
        'start_date',
        'deadline',
        'completed_at',
        'order',
        'attachments',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'completed_at' => 'date',
        'attachments' => 'array',
        'assigned_to' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(InvoiceClient::class, 'client_id');
    }

    public function assignedUsers()
    {
        return User::whereIn('id', $this->assigned_to ?? [])->get();
    }
}
