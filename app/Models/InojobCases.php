<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InojobCases extends Model
{
//  use HasFactory;

    protected $table = '#inojab_cases';
    protected $fillable = [
        'user_id',
        'last_admin',
        'score',
        'status',
        'step'
    ];

    protected $casts = [
        'last_admin' => 'array'
    ];


    protected $attributes = [
        'last_admin' => '[]',
        'status' => 1,
        'step' => 1
    ];

    //-------------------- CRUD Controller

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['custom_score'] , function ($query , $custom_score) {
                return $query->where('score' , $custom_score);
            })
            ->when($filters['min_score'], function ($query, $min_score) {
                return $query->where('score', '<=', $min_score);
            })
            ->when($filters['max_score'], function ($query, $max_score) {
                return $query->where('score', '>=', $max_score);
            })
            ->when($filters['status'], function ($query, $status) {
                return $query->where('status', $status);
            });
    }


    //-------------------- Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
