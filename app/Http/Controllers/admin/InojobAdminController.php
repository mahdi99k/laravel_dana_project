<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\ScoreResource;
use App\Http\Resources\activities\InojobResource;
use App\Traits\activities\inojob\HttpInojob;
use App\Models\Score;
use App\Models\User;
use App\Models\Inojob;
use App\Models\InojobReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Traits\profile\HttpUser;

class InojobAdminController extends Controller
{
  use HttpUser;
  public function getUserData($cert, $type, $userId, Request $req)
  {
    $score = Score::whereUserId($userId)->whereCert($cert)->whereType($type)->latest()->get();
    return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد");
  }
  public function getUserDataCert($cert, $userId, Request $req)
  {
    $score = Score::whereUserId($userId)->whereCert($cert)->latest()->get();
    return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد");
  }

  public function getUser($userId, Request $req)
  {
    $user = User::whereId($userId)->first();
    return $this->successHttpUser(new UserResource($user), "مشخصات کاربر دریافت شد");
  }
  public function getUsers(Request $req)
  {
    $users = User::all();
    return $this->successHttpUser($users, "مشخصات کاربر دریافت شد");
  }
  public function getPriorities($userId , Request $req)
    {
        $user = User::whereId($userId)->first();
        $selected = $user->inojob->priorities;
        // return $selected;
        $inojobs = [];
        // $inojobs = Inojob::whereIn('id', $selected)->get();
        foreach ($selected as $i) {
            $inojob = Inojob::where('id', $i)->first();
            array_push($inojobs, $inojob);
        }
        return InojobResource::collection($inojobs);
        // return $this->successHttpInojob(InojobSelectionRecource::collection($inojobSelections), "اولوی‍ت‌های شغلی دریافت شد", 200);
    }
}
