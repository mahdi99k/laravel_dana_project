<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Model
{
    protected $table = "#users";

    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        "first_name",
        "last_name",
        "birthday",
        "phone",
        "email",
        "melli",
        "inojob",
        "image",
        "more",
        "about",
        "job"
    ];

    protected $casts = [
        "accounts" => 'object',
        "score" => 'object',
        "count" => 'object',
        "image" => 'object',
        "about" => 'object',
        "social" => 'object',
        "more" => 'object',
        "inojob" => 'object',
        "melli" => 'object',
        "job" => 'object',
//      'role' => 'array'
    ];


    protected $attributes = [
        'accounts' => '{"scholar": false,"judge": false,"supervisor": false,"employer": false,"support": false,"bmn":false}',
        'score' => '{"index": 0, "inocoin": 0, "level":1}',
        'count' => '{"projects": 0, "connections": 0, "followings": 0, "followers": 0, "posts": 0}',
        'image' => '{"melli_card":null ,"id_card1":null ,"id_card2":null ,"id_card3":null ,"personal_card":null, "disability_card":null, "military_card":null, "isar_card":null, "passport_1":null, "passport_2":null,"local_citation_card":null}',
        'about' => '{"telephone":null,"father":null,"marital":null,"children_num":null,"gender":null,"military":null,"country:null","province":null,"type":null,"shaba":null}',
        'social' => '{"linkedin":null,"research_gate":null,"scopus":null,"scolar":null,"website":null}',
        'more' => '{"country":null, "city": null, "longitude": null, "latitude":null, "nationality":null,"nationality_other":null,"postal":null,"address":null,"latin_fName":null,"latin_lName":null,"birth_country":null,"birth_province":null,"birth_city":null,"disability":null,"emergency":null,"isar":null,"local_citation":null}',
        'inojob' => '{"priorities":{},"personal_status":0,"priority_status":0,"score":0,"degree":null}',
        'melli' => '{"code":null,"serial":null,"city":null,"number":null,"area":null}',
        'job' => '{"title":null,"company":null,"phone":null,"address":null,"contract":null}'
    ];


    public function score(): HasMany
    {
        return $this->HasMany(Score::class);
    }

    public function inojobReviews(): HasMany
    {
        return $this->HasMany(InojobReviews::class);
    }

    public function updateLastSeen()
    {
        $this->last_seen_at = now();
        $this->save();
    }
}
