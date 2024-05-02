<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalMajors extends Model
{
//    use HasFactory;
    protected $table = '#festival_majors';
    protected $fillable = [
        'name',
        'festival_level_id'
    ];

    public function festivalLevel()
    {
        return $this->belongsTo(FestivalLevel::class, 'festival_level_id');
    }

}
