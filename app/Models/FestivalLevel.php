<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalLevel extends Model
{
//    use HasFactory;
    protected $table = '#festival_levels';
    protected $fillable = [
        'name',
        'festival_type_id',
    ];


    public function festivalType()
    {
        return $this->belongsTo(FestivalType::class, 'festival_type_id');
    }

    public function festivalMajors()
    {
        return $this->hasMany(FestivalMajors::class, 'festival_level_id');
    }
}
