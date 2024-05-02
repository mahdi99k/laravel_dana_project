<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalType extends Model
{
//    use HasFactory;
    protected $table = '#festival_types';
    protected $fillable = ['name'];


    public function festivalLevels()
    {
        return $this->hasMany(FestivalLevel::class , 'festival_type_id');
    }

}
