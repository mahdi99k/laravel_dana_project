<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InojobEmployer extends Model
{
    protected $table = "#inojob_employers";
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "description",
        "count",
        "image"
    ];
    
    public function inojobs(): HasMany
    {
        return $this->hasMany(Inojob::class);
    }
}
