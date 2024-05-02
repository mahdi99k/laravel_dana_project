<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreInfo extends Model
{
//    use HasFactory;

    protected $table = "#score_info";
    protected $fillable = [
        "cert",
        "type",
        "filter",
        'data',
    ];

    protected $casts = [
        'data' => 'object'
    ];

    protected $attributes = [
        'data' => '{"desc1":null,"desc2":null}'
    ];


}
