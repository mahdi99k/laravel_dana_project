<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = "#universities";
    protected $fillable = [
        'name',
        'grantin',
        'code',
        'province_id'
    ];

    public function province(): belongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'], function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            });
        // Add more filter conditions for other fields as needed
    }
}
