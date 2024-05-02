<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
//  use HasFactory;

    protected $table = '#publishers';
    protected $fillable = [
        'name',
        'max_score'
    ];

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'], function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($filters['max_score'], function ($query, $max_score) {
                return $query->where('max_score', $max_score);
            });
    }

}
