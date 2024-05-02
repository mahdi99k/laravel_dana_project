<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InojobSelections extends Model
{
    protected $table = "#inojob_selections";

    use HasFactory;
    protected $fillable = [
        "user_id",
        "inojob_id",
        "priority"
    ];
    protected $hidden = [
        "user_id",
        "inojob_id"
    ];
}
