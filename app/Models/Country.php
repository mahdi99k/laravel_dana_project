<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $table = "countries";
    protected $fillable = [
        'id',
        'name',
    ];

    public function province(): HasMany
    {
        return $this->HasMany(Province::class);
    }

}
