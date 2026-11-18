<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'name',
        'nik',
        'address',
        'phone',
        'email',
        'occupation',
        'information_requested',
        'purpose',
        'how_to_get',
        'status',
        'response',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function objections()
    {
        return $this->hasMany(Objection::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
