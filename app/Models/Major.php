<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = "#majors";
    protected $fillable = ['name'];

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'], function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            });
        // Add more filter conditions for other fields as needed
    }
}
