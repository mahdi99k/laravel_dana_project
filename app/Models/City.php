<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $fillable = [
        'name',
        'slug',
        'province_id'
    ];

    public function province(): belongsTo
    {
        return $this->belongsTo(Province::class);
    }


}
