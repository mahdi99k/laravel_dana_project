<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InojobReviews extends Model
{

    use HasFactory;
    protected $table = '#inojob_reviews';
    protected $fillable = [
        "user_id",
        "type",
        "body",
        "status"
    ];
    protected $hidden = [
        "user_id",
    ];
    
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}

