<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $table = "#scores";
    protected $fillable = [
        "user_id",
        "cert",
        "type",
        "filter",
        "data",
        "file1",
        "file2",
        "status",
        "auto_score",
        "admin_score"
    ];
    protected $casts = [
        "data" => 'object',
    ];
    use HasFactory;

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function count()
    {

    }
}
