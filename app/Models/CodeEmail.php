<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeEmail extends Model
{
//    use HasFactory;

    protected $table = '#code_email';
    protected $fillable = [
        'email',
        'code',
        'expire'
    ];
}
