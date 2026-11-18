<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'category',
        'year',
        'is_active',
        'download_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer',
        'download_count' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeBerkala($query)
    {
        return $query->where('category', 'berkala');
    }

    public function scopeSertaMerta($query)
    {
        return $query->where('category', 'serta-merta');
    }

    public function scopeSetiapSaat($query)
    {
        return $query->where('category', 'setiap-saat');
    }
}
