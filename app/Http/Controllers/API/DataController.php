<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\DataResource;
use App\Http\Resources\Data\JournalResource;
use App\Http\Resources\Data\PublisherResource;
use App\Models\FestivalMajors;
use App\Models\Publisher;
use App\Models\Score;
use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\City;
use App\Models\Country;
use App\Models\Journal;
use App\Models\Major;
use App\Models\University;
use App\Models\User;
use App\Traits\HttpData;


class DataController extends Controller
{
    use Httpdata;

    public function getCountries()
    {
        $countries = Country::all();
        return $this->successHttpData(DataResource::collection($countries), "لیست کشور ها");
    }

    public function getProvinces()
    {
        $provinces = Province::all();
        return $this->successHttpData(DataResource::collection($provinces), "لیست استان ها");
    }

    public function getCities($id)
    {
        $cities = City::where('province_id', $id)->get();
        return $this->successHttpData(DataResource::collection($cities), "لیست شهر ها");
    }

    public function getJournals(Request $req)
    {
        $filters = $req->all();
        $filters = [
            'name' => $req->input('name'),
            'cat' => $req->input('cat'),
            'is_internal' => $req->input('is_internal'),
            // Add more filters here
        ];
        // $type = $req->type ?? null;
        // $is_internal = $type == 'internal' ? 1 : 0;
        $journals = Journal::filter($filters)->paginate(10);

        // else if ($req->cat == "book") $journals = $journals->where('cat', "book")->paginate(10);
        // if ($req->cat != "book") $journals = $journals->where('cat', '!=', "book")->paginate(10);
        return JournalResource::collection($journals);
    }


    public function getPublisher(Request $req)
    {
        $filters = $req->all();
        $filters = [
            'name' => $req->input('name'),
            'max_score' => $req->input('max_score')
        ];
        $publisher = Publisher::filter($filters)->paginate(10);
        return PublisherResource::collection($publisher);
    }


    public function getMajors(Request $req)
    {
        $filters = $req->all();
        $filters = [
            'name' => $req->input('name'),
            // Add more filters here
        ];
        $majors = Major::filter($filters)->paginate(10);
        return DataResource::collection($majors);
    }

    public function getScoreMajors()
    {
        $scoreAllMajors = FestivalMajors::distinct()->get('name');
        $resourceScoreAllMajors = DataResource::collection($scoreAllMajors);
        return $this->successHttpData($resourceScoreAllMajors, "نمایش لیست رشته های مسابقات با موفقیت انجام شد");
    }

    public function getUniversities(Request $req)
    {
        $filters = $req->all();
        $filters = [
            'name' => $req->input('name'),
            // Add more filters here
        ];
        $universities = University::filter($filters)->paginate(10);
        return DataResource::collection($universities);
    }

}
