<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inojob extends Model
{
    protected $table = "#inojobs";

    use HasFactory;

    protected $fillable = [
        "employer_id"
    ];

    protected $casts = [
        "location" => 'object',
        "date" => 'object',
        "count" => 'object',
        "facilities" => 'array',
        "properties" => 'object',
        "emp" => 'object',
        "major" => 'array'
    ];


    protected $attributes = [
        'emp' => '{"id": null, "name": null}',
        'location' => '{"province": null, "spot": null}',
        'properties' => '{"type": null, "site": null, "salary": null}',
        'pin' => '[]',
        'group' => '{"id":1,"cat":1}',
        'major' => '[]',
        'date' => '{"publishDate": null, "endDate": null}',
        'count' => '{"count": 0, "requests": 0, "views": [], "likes": [], "free_man":0, "free_woman":0, "free_both":0, "isar_5_man": 0, "isar_5_woman": 0, "isar_5_both": 0, "isar_25_man": 0, "isar_25_woman": 0, "isar_25_both": 0, "malool_man": 0, "malool_woman": 0, "malool_both": 0}',
        'facilities' => '{}',
        'description' => 'توضیحات ندارد'
    ];

    // public function getDegreeAttribute($val){

    //     $degrees = [
    //         "bachelor"=>"کارشناسی و بالاتر",
    //         "master"=>"کارشناسی ارشد و بالاتر",
    //         "doctor"=>"دکتری و بالاتر"
    //     ];
    //     return $degrees[$val];
    // }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['title'], function ($query, $title) {
                return $query->where(function ($query) use ($title){
                    return $query->where('title', 'like', '%' . $title . '%')
                    ->orWhere('id', 'like', '%' . $title . '%');
                });
            })
            ->when($filters['group'], function ($query, $group) {
                return $query->where('group->cat', $group);
            })
            ->when($filters['province'], function ($query, $province) {
                return $query->where('location->province','LIKE', "%{$province}%");
            })
            ->when($filters['type'], function ($query, $type) {
                return $query->where('properties->type', $type);
            })
            ->when($filters['min_salary'], function ($query, $minSalary) {
                return $query->where('properties->salary', '>=', $minSalary);
            })
            ->when($filters['max_salary'], function ($query, $maxSalary) {
                return $query->where('properties->salary', '<=', $maxSalary);
            })
            ->when($filters['gender'], function ($query, $gender) {
                return $query->where('properties->gender', $gender);
            })
            ->when($filters['degree'], function ($query, $degree) {
                return $query->whereRaw('LOWER(degree) = ?', strtolower($degree));
            })
            ->when(!empty($filters['major']), function ($query) use ($filters) {
                foreach ($filters['major'] as $major) {
            //         // return $query->WhereJsonContains('major', $major)->WhereJsonContains('major','all');
            //         return $query->WhereJsonContains('major', $major);
                        return $query->where(function($query) use ($major){
                            $query->WhereJsonContains('major', $major)
                            ->orWhereJsonContains('major','all');
                        });

                }
            })
            ->when(!empty($filters['facilities']), function ($query) use ($filters) {
                return $query->whereIn('facilities', $filters['facilities']);
            })
            ->when($filters['employer'], function ($query, $employer) {
                return $query->whereHas('employer', function ($query) use ($employer) {
                    $query->where('name', $employer);
                });
            });
        // Add more filter conditions for other fields as needed
    }


    public function employer(): BelongsTo
    {
        return $this->belongsTo(InojobEmployer::class);
    }


}
