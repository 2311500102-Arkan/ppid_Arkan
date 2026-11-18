<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objection extends Model
{
    use HasFactory;

    protected $fillable = [
        'objection_number',
        'name',
        'address',
        'phone',
        'information_request_id',
        'reason',
        'status',
        'response',
    ];

    public function informationRequest()
    {
        return $this->belongsTo(InformationRequest::class, 'information_request_id');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
