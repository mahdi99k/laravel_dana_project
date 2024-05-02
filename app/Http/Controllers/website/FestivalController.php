<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Resources\FestivalResource;
use App\Models\FestivalLevel;
use App\Models\FestivalMajors;
use App\Models\FestivalType;
use App\Traits\HttpData;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    use HttpData;

    public function getFestivalType()
    {
        $festivalTypes = FestivalType::get();
        $resourceFestivalType = FestivalResource::collection($festivalTypes);
        return $this->successHttpData($resourceFestivalType, 'مقدار نوع جشنواره با موفقیت دریافت شد');
    }

    public function getFestivalLevel($id)
    {
        $festivalLevel = FestivalType::findOrFail($id)->festivalLevels;
        $resourceFestivalLevel = FestivalResource::collection($festivalLevel);
        return $this->successHttpData($resourceFestivalLevel, "مقدار لول های فستیوال با موفقیت دریافت شد");
    }

    public function getFestivalMajor($id)
    {
        if ($id == "9" || $id == "10" || $id == "11" || $id == "12") {
            $festivalMajor = FestivalMajors::distinct()->get('name');  //Preventing repetition of festival majors
            $resourceFestivalLevel = FestivalResource::collection($festivalMajor);
            return $this->successHttpData($resourceFestivalLevel, "مقدار رشته های فستیوال با موفقیت دریافت شد");
        }

        if ($id >= 13) {
            return $this->errorHttpData([], "فستیوال مورد نظر یافت نشد", 404);
        }

        $festivalMajor = FestivalLevel::findOrFail($id)->festivalMajors;
        $resourceFestivalLevel = FestivalResource::collection($festivalMajor);
        return $this->successHttpData($resourceFestivalLevel, "مقدار رشته های فستیوال با موفقیت دریافت شد");
    }


}
