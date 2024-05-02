<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorCoefficients extends Model
{
//  use HasFactory;
    protected $table = "#major_coefficients";
    protected $fillable = [
        'university_id',
        'university',
        'field_id',
        'major',
        'bachelor',
        'master',
        'phd',
    ];
}
