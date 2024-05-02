<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = "#journals";
    protected $fillable = [
        'name',
        'cat',
        'is_internal'
    ];

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'], function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($filters['cat'], function ($query, $cat) {
                return $query->where('cat', $cat);
            })
            ->when($filters['is_internal'], function ($query, $is_internal) {
                if ($is_internal == 1) {
                    return $query->whereBetween('is_internal', [0, 2]);
                } else if ($is_internal == 3) {
                    return $query->where('is_internal', 3)->orWhere('is_internal', 0);
                }
            });
        /*->when($filters['type'], function ($query, $type) {

            return $query->where('type', $type);
        });*/
        // Add more filter conditions for other fields as needed
    }

}
