<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $table = "provinces";
    protected $fillable = [
        'name',
        'slug',
        'country_id'
    ];

    public function city(): HasMany
    {
        return $this->HasMany(City::class);
    }

    public function university(): HasMany
    {
        return $this->HasMany(University::class);
    }

    public function country(): belongsTo
    {
        return $this->belongsTo(Country::class);
    }


}
