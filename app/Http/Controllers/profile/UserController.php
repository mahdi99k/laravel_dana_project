<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\sendUserCaseRequest;
use App\Http\Resources\ScoreInfoResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ScoreResource;
use App\Models\InojobCases;
use App\Models\Journal;
use App\Models\MajorCoefficients;
use App\Models\ScoreInfo;
use App\Models\User;
use App\Models\Score;
use App\Traits\profile\HttpUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpUser;

    public function updateJsonFields(Request $req)
    {
        $attributes = [
            'accounts' => '{"scholar": false,"judge": false,"supervisor": false,"employer": false,"support": false,"bmn":false}',
            'score' => '{"index": 0, "inocoin": 0, "level":1}',
            'count' => '{"projects": 0, "connections": 0, "followings": 0, "followers": 0, "posts": 0}',
            'image' => '{"melli_card":null ,"id_card1":null ,"id_card2":null ,"id_card3":null ,"personal_card":null, "disability_card":null, "military_card":null, "isar_card":null, "passport_1":null, "passport_2":null,"local_citation_card":null}',
            'about' => '{"telephone":null,"father":null,"marital":null,"children_num":null,"gender":null,"military":null,"province":null,"type":null,"shaba":null}',
            'social' => '{"linkedin":null,"research_gate":null,"scopus":null,"scolar":null,"website":null}',
            'more' => '{"country":null, "city": null, "longitude": null, "latitude":null, "nationality":null,"nationality_other":null,"postal":null,"address":null,"latin_fName":null,"latin_lName":null,"birth_country":null,"birth_province":null,"birth_city":null,"disability":null,"emergency":null,"isar":null,"local_citation":null}',
            'inojob' => '{"priorities":{},"personal_status":0,"priority_status":0,"score":0,"degree":null}',
            'melli' => '{"code":null,"serial":null,"city":null,"number":null,"area":null}',
            'job' => '{"title":null,"company":null,"phone":null,"address":null,"contract":null}'
        ];
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id == 22) {
                // Get the user's JSON field values (already casted to array)
                $jsonFields = $user->getAttributes();

                // Check if the user has extra JSON keys
                $extraKeys = array_diff(array_keys($jsonFields), array_keys($attributes));

                // Remove extra keys from the user's JSON field
                foreach ($extraKeys as $extraKey) {
                    unset($user->$extraKey);
                }

                // Check and add missing keys with default values, preserving existing values
                foreach ($attributes as $key => $value) {
                    // If the key doesn't exist or its value is an empty array, set it to the default value
                    if (!isset($jsonFields[$key]) || (is_array($jsonFields[$key]) && empty(array_filter($jsonFields[$key])))) {
                        $user->$key = json_decode($value, true);
                    }
                }

                // Save the changes to the user
                $user->save();
            }
        }
    }


    public function getUser(Request $req)
    {
        // *** WAYS TO GET USER :) TNX SANCTUM ***
        //1.$req->user(), auth('sanctum')->user(), Auth::user()
        // return "working";
        // $inojobReviews = InojobReviews::whereUserId($req->user()->id)->get();
        // $req->user()->merge($inojobReviews);
        $user = User::whereId($req->user()->id)->first();
        return $this->successHttpUser(new UserResource($user), "اطلاعات کاربر دریافت شد");
    }

    public function updateUser(Request $req)
    {
        $id_card1 = $req->id_card1 ? $this->uploadUserImage($req->id_card1, $req->user()->id) : null;
        $id_card2 = $req->id_card2 ? $this->uploadUserImage($req->id_card2, $req->user()->id) : null;
        $id_card3 = $req->id_card3 ? $this->uploadUserImage($req->id_card3, $req->user()->id) : null;
        $melli_card = $req->melli_card ? $this->uploadUserImage($req->melli_card, $req->user()->id) : null;
        $military_card = $req->military_card ? $this->uploadUserImage($req->military_card, $req->user()->id) : null;
        $personal_card = $req->personal_card ? $this->uploadUserImage($req->personal_card, $req->user()->id) : null;
        $disability_card = $req->disability_card ? $this->uploadUserImage($req->disability_card, $req->user()->id) : null;
        $isar_card = $req->isar_card ? $this->uploadUserImage($req->isar_card, $req->user()->id) : null;
        $passport_1 = $req->passport_1 ? $this->uploadUserImage($req->passport_1, $req->user()->id) : null;
        $passport_2 = $req->passport_2 ? $this->uploadUserImage($req->passport_2, $req->user()->id) : null;
        $local_citation_card = $req->local_citation_card ? $this->uploadUserImage($req->local_citation_card, $req->user()->id) : null;

        //$superAdmin = ["super_admin", "admin_ostani", "admin_setadi", "admin_davari", "admin_kanoon_arzyaban"];
        //return $id_card1;
        //$user = User::wherePhone($req->phone)->first;

        $data = [
            "first_name" => !$req->has('first_name') ? $req->user()->first_name : $req->first_name,
            "last_name" => !$req->has('last_name') ? $req->user()->last_name : $req->last_name,
            "birthday" => !$req->has('birthday') ? $req->user()->birthday : $req->birthday,
            "email" => !$req->has('email') ? $req->user()->email : $req->email,
//          'role' => $req->has('role') ? ($req->role === 'super_admin' ? $superAdmin : explode(',', str_replace(' ', '', $req->role))) : ["normal_user"],
            "about" => [
                "father" => !$req->has('father') ? $req->user()->about->father : $req->father,
                "gender" => !$req->has('gender') ? $req->user()->about->gender : $req->gender,
                "marital" => !$req->has('marital') ? $req->user()->about->marital : $req->marital,
                "children_num" => !$req->has('children_num') ? $req->user()->about->children_num : $req->children_num,
                "military" => !$req->has('military') ? $req->user()->about->military : $req->military,
                "province" => !$req->has('province') ? $req->user()->about->province : $req->province,
                "shaba" => !$req->has('shaba') ? $req->user()->about->shaba : $req->shaba,
                "telephone" => !$req->has('telephone') ? $req->user()->about->telephone : $req->telephone,
                "type" => !$req->has('type') ? $req->user()->about->type : $req->type
            ],
            "image" => [
                "id_card1" => $id_card1,
                "id_card2" => $id_card2,
                "id_card3" => $id_card3,
                "melli_card" => $melli_card,
                "military_card" => $military_card,
                "personal_card" => $personal_card,
                "disability_card" => $disability_card,
                'isar_card' => $isar_card,
                'passport_1' => $passport_1,
                'passport_2' => $passport_2,
                'local_citation_card' => $local_citation_card
            ],
            "melli" => [
                "code" => !$req->has('melli_code') ? $req->user()->melli->code : $req->melli_code,
                "serial" => !$req->has('melli_serial') ? $req->user()->melli->serial : $req->melli_serial,
                "number" => !$req->has('melli_number') ? $req->user()->melli->number : $req->melli_number,
                "city" => !$req->has('melli_city') ? $req->user()->melli->city : $req->melli_city,
                'area' => !$req->has('melli_area') ? $req->user()->melli->area : $req->melli_area,
            ],
            "more" => [
                "nationality" => !$req->has('nationality') ? $req->user()->more->nationality : $req->nationality,
                "nationality_other" => !$req->has('nationality_other') ? $req->user()->more->nationality_other : $req->nationality_other,
                "postal" => !$req->has('postal') ? $req->user()->more->postal : $req->postal,
                "city" => !$req->has('city') ? $req->user()->more->city : $req->city,
                "country" => !$req->has('country') ? $req->user()->more->country : $req->country,
                "address" => !$req->has('address') ? $req->user()->more->address : $req->address,
                "latin_fName" => !$req->has('latin_fName') ? $req->user()->more->latin_fName : $req->latin_fName,
                "latin_lName" => !$req->has('latin_lName') ? $req->user()->more->latin_lName : $req->latin_lName,
                "birth_country" => !$req->has('birth_country') ? $req->user()->more->birth_country : $req->birth_country,
                "birth_province" => !$req->has('birth_province') ? $req->user()->more->birth_province : $req->birth_province,
                "birth_city" => !$req->has('birth_city') ? $req->user()->more->birth_city : $req->birth_city,
                "disability" => !$req->has('disability') ? $req->user()->more->disability : $req->disability,
                "emergency" => !$req->has('emergency') ? $req->user()->more->emergency : $req->emergency,
                'isar' => !$req->has('isar') ? $req->user()->more->isar : $req->isar,
                'local_citation' => !$req->has('local_citation') ? $req->user()->more->local_citation : $req->local_citation,
            ],
            "job" => [
                "title" => !$req->has('job_title') ? $req->user()->job->title : $req->job_title,
                "company" => !$req->has('job_company') ? $req->user()->job->company : $req->job_company,
                "phone" => !$req->has('job_phone') ? $req->user()->job->phone : $req->job_phone,
                "address" => !$req->has('job_address') ? $req->user()->job->address : $req->job_address,
                "contract" => !$req->has('job_contract') ? $req->user()->job->contract : $req->job_contract,
            ],
        ];
        // return $data;
        $req->user()->update($data);
        $image = [
            "id_card1" => $id_card1,
            "id_card2" => $id_card2,
            "id_card3" => $id_card3,
            "melli_card" => $melli_card,
            "military_card" => $military_card,
            "personal_card" => $personal_card,
            "disability_card" => $disability_card,
            'isar_card' => $isar_card,
            'passport_1' => $passport_1,
            'passport_2' => $passport_2,
            'local_citation_card' => $local_citation_card
        ];

        $req->user()->image = $image;
        $req->user()->save();
        // $inojobReviews = InojobReviews::WhereUserId($req->user()->id)->get();
        // $inojob
        $user = User::whereId($req->user()->id)->first();
        return $this->successHttpUser(new UserResource($user), "اطلاعات کاربر بروزرسانی شد");
    }


    public function userUpload(Request $req)
    {
        // $req->validate([
        //     'file' => 'required|mimes:jpg,jpeg,webp,png,|max:500',
        // ]);
        $time = time();
        $rand = rand(10000, 99999);
        $random = $time - $rand;
        $year = date("Y");
        $month = date("m");
        $days = date("d");
        // $accept = ['id_card', 'melli_card', 'personal_card'];
        // if (!in_array($req->name, $accept)) return $this->errorHttpUser([], 'دسترسی آپلود ندارید', 401);
        $fileName = "{$random}.{$req->user()->id}.{$req->file->extension()}";
        $path = "/uploads/users/$year/$month/$days/{$fileName}"; //image name
        $req->file->move(public_path("uploads/users/$year/$month/$days/"), $fileName);
        // return $fileName;
        $name = $req->name;
        $user_image = $req->user()->image;
        if ($user_image->{$name} != null) unlink(public_path($user_image->{$name}));
        $user_image->{$name} = $path;
        $req->user()->image = $user_image;
        $req->user()->save();
        return $this->successHttpUser($path, "اطلاعات کاربر بروزرسانی شد");
    }


    /*public function userUpload(Request $req)
    {
        $this->checkvalidationusers($req);
        // $req->validate([
        //     'file' => 'required|mimes:jpg,jpeg,webp,png,|max:500',
        // ]);
        $time = time();
        $rand = rand(10000, 99999);
        $random = $time - $rand;
        // $accept = ['id_card', 'melli_card', 'personal_card'];
        // if (!in_array($req->name, $accept)) return $this->errorHttpUser([], 'دسترسی آپلود ندارید', 401);
        $fileName = "{$random}.{$req->user()->id}.{$req->file->extension()}";
        $path = "/uploads/cert/temp/{$fileName}";
        $req->file->move(public_path('uploads/cert/temp'), $fileName);
        // return $fileName;
        $name = $req->name;
        $user_image = $req->user()->image;
        if ($user_image->{$name} != null) unlink(public_path($user_image->{$name}));
        $user_image->{$name} = $path;
        $req->user()->image = $user_image;
        $req->user()->save();
        return $this->successHttpUser($path, "اطلاعات کاربر بروزرسانی شد");
    }*/
    public function scoreUpload(Request $req)
    {
        $time = time();
        $rand = rand(10000, 99999);
//      $random = $time - $rand;

        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        $random = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

//         $output = new \Symfony\Component\Console\Output\ConsoleOutput();
//         $output->writeln("<info>my message</info>");
        // $accept = ['id_card', 'melli_card', 'personal_card'];
        // if (!in_array($req->name, $accept)) return $this->errorHttpUser([], 'دسترسی آپلود ندارید', 401);
        $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "webp");

        $extension = $req->file->extension();
        if (in_array($extension, $allowedExts)) {
            $year = date("Y");
            $month = date("m");
            $days = date("d");

            $fileName = "{$random}.{$req->user()->id}.{$req->file->extension()}";
            $path = "/uploads/scores/$year/$month/$days/{$fileName}";
            $req->file->move(public_path("uploads/scores/$year/$month/$days/"), $fileName);
            return $this->successHttpUser($path, "آپلود شد");
        } else {
            return $this->errorHttpUser([], "خطا در بارگذاری فایل. فرمت صحیح نیست.", 403);
        }
    }


    public function uploadScore($file, $userId)
    {
        // $file = str_replace("/", "", $file);

        $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "webp");

        $temp = explode(".", $file);

        $extension = end($temp);
        if (in_array($extension, $allowedExts)) {
            $time = time();
            $rand = rand(10000, 99999);
//          $random = $time - $rand;
            $year = date("Y");
            $month = date("m");
            $days = date("d");
            if (function_exists('com_create_guid') === true) {
                return trim(com_create_guid(), '{}');
            }

            $random = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

            $fileExtArr = explode(".", $file);
            $fileExt = end($fileExtArr);
            $fileName = public_path("{$file}");
            $newFile = "/uploads/scores/$year/$month/$days/{$random}.{$userId}.{$fileExt}";
            if (file_exists($fileName)) {
                File::move($fileName, public_path($newFile));
            } else {
                return null;
            }

            return $newFile;
        } else {
            return null;
        }
    }

    public function uploadUserImage($file, $userId)
    {
        // $file = str_replace("/", "", $file);
        $time = time();
        $rand = rand(10000, 99999);
        $random = $time - $rand;
        $year = date("Y");
        $month = date("m");
        $days = date("d");

        $fileExtArr = explode(".", $file);
        $fileExt = end($fileExtArr);
        $fileName = public_path("{$file}");
        // return [$fileName,file_exists($fileName)];
        $newFile = "/uploads/users/$year/$month/$days/{$random}.{$userId}.{$fileExt}";
        if (file_exists($fileName)) {
            File::move($fileName, public_path($newFile));
        } else {
            return null;
        }

        return $newFile;
    }

    public function addScore(Request $req)
    {
        // $req->validate([
        //     'file1' => 'required|mimes:pdf|max:3000',
        //     'file2' => 'required|mimes:pdf|max:3000',
        // ]);
        $user_degree = $this->currentDegree($req->user()->id);
        /*if ($req->cert == 'research') {
            if ($req->type == 'article') {
                $canUploadArticle = $this->checkCanUploadArticle($req->user()->id, $user_degree);
                if (!$canUploadArticle) return $this->errorHttpUser([], "شما به حداکثر تعداد مجاز برای ثبت مقاله رسیده اید", 403);
            } else if ($req->type == 'book') {
                $canUploadArticle = $this->checkCanUploadBook($req->user()->id, $user_degree);
                if (!$canUploadArticle) return $this->errorHttpUser([], "شما به حداکثر تعداد مجاز برای ثبت کتاب رسیده اید", 403);
            }
        }*/
        // return $this->uploadScore($req->file1, $req->user()->id);
        $file1 = $req->file1 ? $this->uploadScore($req->file1, $req->user()->id) : null;
        $file2 = $req->file2 ? $this->uploadScore($req->file2, $req->user()->id) : null;
        $res = Score::create([
            "user_id" => $req->user()->id,
            "cert" => $req->cert,
            "type" => $req->type,
            "filter" => $req->filter,
            "data" => $req->data,
            "file1" => $file1,
            "file2" => $file2,
        ]);
        $cert = $res->cert;
        $type = $res->type;
        $user_degree = $this->currentDegree($req->user()->id);
        $user_degree_possible = in_array($user_degree, ["bachelor", "master", "doctor"]) ? true : false;
        $cantAdd = false;
        /*if ($cert == 'research') {
            if ($type == 'article') {
                $canUploadArticle = $this->checkCanUploadArticle($req->user()->id, $user_degree);
                if (!$canUploadArticle) $cantAdd = "شما به حداکثر تعداد مجاز برای ثبت مقاله رسیده اید";
            } else if ($type == 'book') {
                $canUploadArticle = $this->checkCanUploadBook($req->user()->id, $user_degree);
                if (!$canUploadArticle) $cantAdd = "شما به حداکثر تعداد مجاز برای ثبت کتاب رسیده اید";
            }
        }*/
        $cantAdd = $user_degree;
        if (!$user_degree_possible) $cantAdd = "برای ثبت مقاله باید حداقل یکی از مدارک دکتری، کارشناسی ارشد و یا کارشناسی داشته باشید";
        $info = compact("cantAdd");

        return $this->successHttpUser(new ScoreResource($res), "امتیاز کاربر افزوده شد", $info);
    }

    public function updateScore($id, Request $req)
    {
        $score = Score::whereId($id)->whereUserId($req->user()->id)->first();
        $res = $score->update([
            "filter" => $req->filter,
            "data" => $req->data,
            "file1" => $req->file1,
            "file2" => $req->file2,
        ]);

        //IF USER HAS EDITED THE SCORE AFTER BEING CHECKED BY ADMIN
        if ($score->status == 2 || $score->status == 3) {
            $score->update(["status" => 4]);
        }

        $updateDegree = $this->currentDegree($req->user()->id);
        return $this->successHttpUser(new ScoreResource($score), "امتیاز کاربر ادیت شد",);
    }

    public function deleteScore($id, Request $req)
    {
        $score = Score::whereId($id)->whereUserId($req->user()->id)->first();
        $res = $score->delete();
        $scores = Score::whereUserId($req->user()->id)->get();
        $updateDegree = $this->currentDegree($req->user()->id);
        return $this->successHttpUser(ScoreResource::collection($scores), "امتیاز حذف  شد");
    }

    public function getScores(Request $req)
    {
        $scores = Score::whereUserId($req->user()->id)->latest()->get();
        $invalidDegree = ($cert == "training" && $type == "edu") ? false : $this->invalidDegree($req->user()->id);
        if ($invalidDegree) return $this->errorHttpUser([], $invalidDegree, 403);
        return $this->successHttpUser(ScoreResource::collection($scores), "امتیازات کاربر دریافت شد");
    }

    public function getScore(Request $req)
    {
        $score = Score::whereId($req->id)->whereUserId($req->user()->id)->get();
        $invalidDegree = ($cert == "training" && $type == "edu") ? false : $this->invalidDegree($req->user()->id);
        if ($invalidDegree) return $this->errorHttpUser([], $invalidDegree, 403);
        return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد");
    }

    public function getCertScores($cert, Request $req)
    {
        $score = Score::whereUserId($req->user()->id)->whereCert($cert)->latest()->get();
        $invalidDegree = ($cert == "training" && $type == "edu") ? false : $this->invalidDegree($req->user()->id);
        if ($invalidDegree) return $this->errorHttpUser([], $invalidDegree, 403);
        return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد");
    }

    public function getCertTypeScores($cert, $type, Request $req)
    {
        $user_degree = $this->currentDegree($req->user()->id);
        $cantAdd = false;
        /*if ($cert == 'research') {
            if ($type == 'article') {
                $canUploadArticle = $this->checkCanUploadArticle($req->user()->id, $user_degree);
                if (!$canUploadArticle) $cantAdd = "شما به حداکثر تعداد مجاز برای ثبت مقاله رسیده اید";
            } else if ($type == 'book') {
                $canUploadArticle = $this->checkCanUploadBook($req->user()->id, $user_degree);
                if (!$canUploadArticle) $cantAdd = "شما به حداکثر تعداد مجاز برای ثبت کتاب رسیده اید";
            }
        }*/
        $info = compact("cantAdd");
        $score = Score::whereUserId($req->user()->id)->whereCert($cert)->whereType($type)->latest()->get();
        $invalidDegree = ($cert == "training" && $type == "edu") ? false : $this->invalidDegree($req->user()->id);
        if ($invalidDegree) return $this->errorHttpUser([], $invalidDegree, 403);
        return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد", $info);
    }

    public function currentDegree($userId)
    {
        $degrees = [
            "diploma",
            "associate",
            "mullah2",
            "mullah3",
            "mullah4",
            "mullah_second_term",
            "bachelor",
            "con_master",
            "master",
            "pro_doctor",
            "phd",
            "con_specialist_phd",
            "con_phd"
        ];
        $user = User::whereId($userId)->first();
        $user_inojob = $user->inojob;
        $current = 0;
        $scores = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->get();
//      $scores = Score::whereUserId($userId)->get();
        foreach ($scores as $score) {
            if (array_search($score->filter, $degrees) > $current) {
                $user_inojob->degree = $score->filter;
                $current = array_search($score->filter, $degrees);
            }
        }
        $user->inojob = $user_inojob;
        $user->save();
        return $user_inojob->degree;
    }

    public function invalidDegree($userId)
    {
        $user_degrees = [];
        $user = User::whereId($userId)->first();
        $scores = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->get();
        foreach ($scores as $score) {
            array_push($user_degrees, $score->filter);
        }
        $user_degrees = array_unique($user_degrees);
//      return 0;

        if (in_array("con_master", $user_degrees) || in_array("pro_doctor", $user_degrees))
            return 0;

        else if (in_array("phd", $user_degrees)) {  //phd->master+bachelor OR phd->con_master
            if (in_array("master", $user_degrees)) {
                if (in_array("bachelor", $user_degrees)) {
                    return 0;
                } else {
                    return "مدرک کارشناسی خود را نیز ثبت کنید";
                }

            } else if (in_array("con_master", $user_degrees)) {
                return 0;

            } else {
                return "در کنار دکتری تخصصی شما باید مدارک کارشناسی بهمراه کارشناسی ارشد را ثبت کنید. (و یا مدرک کارشناسی ارشد پیوسته ثبت نمایید)";
            }

        } else if (in_array("master", $user_degrees)) {
            if (in_array("bachelor", $user_degrees)) {
                return 0;
            } else {
                return "باید مدرک کارشناسی خود را نیز ثبت کنید";
            }

        } else if (in_array("bachelor", $user_degrees)) {
            return 0;

        } else if (in_array("con_phd", $user_degrees)) {
            if (in_array("diploma", $user_degrees)) {
                return 0;
            } else {
                return "باید مدرک دیپلم خود را نیز ثبت کنید";
            }

        } else if (in_array("con_specialist_phd", $user_degrees)) {
            if (in_array("bachelor", $user_degrees)) {
                return 0;
            } else {
                return "باید مدرک کارشناسی خود را نیز ثبت کنید";
            }

        } else if (in_array("mullah2", $user_degrees) || in_array("mullah3", $user_degrees)
            || in_array("mullah4", $user_degrees) || in_array("mullah_second_term", $user_degrees)) {
            return 0;
        }

        return "سوابق تحصیلی خود را کامل کنید";
    }


    public function updateUserScore(Request $req, $allScore = false)
    {
        $START_TIME = microtime(true);
        $user = $req->user();
        $userId = $user->id;
        $user_scores = Score::whereUserId($userId)->get();
        $score = 0;
        $scores = [
            "training" => [
                "edu" => 0,
                "olympiad_schools" => 0,
                "olympiad_unis" => 0,
                'medical' => 0,
                'entrance' => 0,
                'sample' => 0,
                'math' => 0,
            ],
            "research" => [
                "article" => 0,
                "book" => 0,
                "cooperation" => 0,
            ],
            "skill" => [
                "internship" => 0,
                "skill_comp" => 0,
                "babaei" => 0,
                "knowledge" => 0,
                "base_certificate" => 0,
                "pro_certificate" => 0,
                "experience" => 0,
                "history_uni" => 0,
                "history_else" => 0,
                "postdoctor" => 0,
                "employment" => 0,
            ],
            "technology" => [
                "assistant" => 0,
                "festival" => 0,
                "robocup" => 0,
                "nano_uni" => 0,
                "nano_school" => 0,
                "invention" => 0,
                "cooperation" => 0,
                "ahmadi" => 0,
                "art_uni" => 0,
                "art_school" => 0,
                "bahaei" => 0,
                "chosen" => 0,
//              "tech" => 0,
            ],
            "culture" => [
                "professional" => 0,
                "cultural" => 0,
                "journals" => 0,
                "management" => 0,
                "journals_head" => 0,
                "assoc_uni" => 0,
                "camp" => 0,
            ]
        ];
        $scores_max = [
            "training" => [
                "olympiad_schools" => 24.75,
                "olympiad_unis" => 30,
                'medical' => 20,
                'entrance' => 15,
                'sample' => 10.5,
                'math' => 15,
            ],
            "research" => [
                "article" => 15,
                "book" => 40,
                "cooperation" => 8,
            ],
            "skill" => [
                "internship" => 6,
                "skill_comp" => 4.5,
                "babaei" => 15,
                "knowledge" => 8,
                "base_certificate" => 10,
                "pro_certificate" => 10,
                "experience" => 8,
                "history_uni" => 6,
                "history_else" => 3,
                "postdoctor" => 18,
                "employment" => 5,
            ],
            "technology" => [
                "assistant" => 4.5,
                "festival" => 40,
                "robocup" => 18,
                "nano_uni" => 18,
                "nano_school" => 21,
                "invention" => 30,
                "cooperation" => 40,
                "ahmadi" => 9,
                "art_uni" => 10,
                "art_school" => 5,
                "bahaei" => 10.8,
                "chosen" => 18,
//              "tech" => 7.2,
            ],
            "cultureAll" => [
                "bachelor" => 3.5,
                "master" => 4,
                "phd" => 5
            ],
            "culture" => [
                "professional" => 2,
                "cultural" => 2,
                "journals" => 2,
                "management" => 2,
                "journals_head" => 2,
                "assoc_uni" => 2,
                "camp" => 2,
            ]
        ];
        $user_degree = @$user->inojob->degree ?? null;

        $scoreAllBookArray = [];     //The sum total of book score
        $scoreAllArticleArray = [];  //The sum total of article score
        foreach ($user_scores as $us) {
            $data = @$us->data ?? null;
            $rank = @$this->strToRank(@$data->rank) ?? null;
            $gpa = @$data->gpa ?? 0;
            if ($us->cert == "training") {
                if ($us->type == "edu") {


                    if ($data->status == "دانش آموخته" || $data->status == "دانشجو") {


                        if ($us->filter == "bachelor" && $us->filter == $user_degree || $us->filter == "mullah3" && $us->filter == $user_degree) {

                            $bachelor = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('bachelor')->first();
                            $mullah3 = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('mullah3')->first();
                            $bachelor_major = $this->major_coefficients_with_univercity($user_degree, !is_null($bachelor) ? $bachelor : $mullah3);
                            $scores['training']['edu'] = min($bachelor_major, 33);

                        } else if ($us->filter == "master" && $us->filter == $user_degree || $us->filter == "mullah4" && $us->filter == $user_degree) {
                            $bachelor = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('bachelor')->first();
                            $master = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('master')->first();
                            $mullah3 = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->whereFilter('mullah3')->first();
                            $mullah4 = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->whereFilter('mullah4')->first();

                            if (!is_null($bachelor)) {
                                $master_major = $this->major_coefficients_with_univercity($user_degree, $bachelor, $master);
                                $scores['training']['edu'] = min($master_major, 39);

                            } elseif (!is_null($mullah3)) {
                                $master_major = $this->major_coefficients_with_univercity($user_degree, $mullah3, $mullah4);
                                $scores['training']['edu'] = min($master_major, 39);
                            }

                        } else if ($us->filter == "pro_doctor" && $us->filter == $user_degree || $us->filter == "con_master" && $us->filter == $user_degree) {
                            $pro_doctor = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('pro_doctor')->first();
                            $con_master = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('con_master')->first();

                            if (!is_null($pro_doctor)) {
                                $pro_doctor_major = $this->major_coefficients_with_univercity($user_degree, null, $pro_doctor);
                                $scores['training']['edu'] = min($pro_doctor_major, 34);

                            } else if (!is_null($con_master)) {
                                $con_master_major = $this->major_coefficients_with_univercity($user_degree, null, $con_master);
                                $scores['training']['edu'] = min($con_master_major, 34);
                            }


                        } else if ($us->filter == "phd" && $us->filter == $user_degree) {
                            //$bachelor = Score::whereUserId($userId)->whereFilter('bachelor')->first();
                            $bachelor = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('bachelor')->first();
                            $master = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('master')->first();
                            $con_master = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('con_master')->first();
                            $phd = Score::whereUserId($userId)->where('cert', 'training')->where('type', 'edu')->whereFilter('phd')->first();

                            if (!is_null($master) && !is_null($bachelor)) {  //check exist master
                                $phd_major = $this->major_coefficients_with_univercity($user_degree, $bachelor, $master, $phd);
                                $scores['training']['edu'] = min($phd_major, 55);

                            } else if (!is_null($con_master)) {
                                $phd_major = $this->major_coefficients_with_univercity($user_degree, null, $con_master, $phd);
                                $scores['training']['edu'] = min($phd_major, 43);
                            }

                        } else if ($us->filter == "mullah_second_term" && $us->filter == $user_degree) {
                            $mullah3 = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->whereFilter('mullah3')->first();
                            $mullah4 = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->whereFilter('mullah4')->first();
                            $mullah_second_term = Score::whereUserId($userId)->whereCert('training')->whereType('edu')->whereFilter('mullah_second_term')->first();

                            $mullah_second_term_major = $this->major_coefficients_with_univercity($user_degree, $mullah3, $mullah4, $mullah_second_term);
                            $scores['training']['edu'] = min($mullah_second_term_major, 55);
                        }

                    }


                } else if ($us->type == "olympiad") {
                    if ($us->filter == "school") {
                        if (@$data->level == "ملی") {
                            $add = $this->olympiad_scoreBased_rank($user_degree, $rank, [[24.75, 13.5, 9], [18.75, 10.5, 6], [11.25, 9, 4.5]]);
                            $scores['training']['olympiad_schools'] += $this->addWithMax($add, $scores['training']['olympiad_schools'], $scores_max["training"]["olympiad_schools"]);

                        } else if (@$data->level == "جهانی") {
                            $add = $this->olympiad_scoreBased_rank($user_degree, $rank, [[24.75, 22.5, 18], [24.75, 19.5, 15], [24.75, 16.5, 12]]);
                            $scores['training']['olympiad_schools'] += $this->addWithMax($add, $scores['training']['olympiad_schools'], $scores_max["training"]["olympiad_schools"]);

                        }
                    } else if ($us->filter == "uni") {
                        if (@$data->ministry == "علوم") {
                            $add = $this->olympiad_scoreBased_rank($user_degree, $rank, [[30, 15, 15], [30, 11.25, 11.25], [15, 7.5, 7.5]]);
                            $scores['training']['olympiad_unis'] += $this->addWithMax($add, $scores['training']['olympiad_unis'], $scores_max['training']['olympiad_unis']);

                        } else if (@$data->ministry == "بهداشت - رتبه انفرادی") {
                            $add = $this->olympiad_scoreBased_rank($user_degree, $rank, [[30, 15, 15], [30, 11.25, 11.25], [15, 7.5, 7.5]]);
                            $scores['training']['olympiad_unis'] += $this->addWithMax($add, $scores['training']['olympiad_unis'], $scores_max['training']['olympiad_unis']);

                        } else if (@$data->ministry == "بهداشت - رتبه گروهی") {
                            $add = $this->olympiad_scoreBased_rank($user_degree, $rank, [[30, 11.25, 11.25], [22.5, 7.5, 7.5], [11.25, 3.75, 3.75]]);
                            $scores['training']['olympiad_unis'] += $this->addWithMax($add, $scores['training']['olympiad_unis'], $scores_max['training']['olympiad_unis']);
                        }
                    }
                } else if ($us->type == 'medical') {
                    $add = $scores['training']['medical'] += $this->addWithMax($this->medical_score($rank, $user_degree), $scores['training']['medical'], $scores_max['training']['medical']);

                } else if ($us->type == "entrance") {
                    $add = $scores['training']['entrance'] += $this->addWithMax($this->entrance_score($rank, $user_degree), $scores['training']['entrance'], $scores_max['training']['entrance']);

                } else if ($us->type == "sample") {
                    $add = $scores['training']['sample'] += $this->addWithMax($this->sample_score($user_degree), $scores['training']['sample'], $scores_max['training']['sample']);

                } else if ($us->type == "math") {
                    $add = $scores['training']['math'] += $this->addWithMax($this->math_score($rank), $scores['training']['math'], $scores_max['training']['math']);

                }


                //shamsi_data -> data persian

            } else if ($us->cert == "research") {
                if ($us->type == "article") {
                    $articleYears = @$data->shamsi_data ?? null;

                    if ($this->checked_8_years_ago($articleYears)) {
                        $articleType = @$us->data->type ?? null;
                        $presentaion = @$us->data->presentaion ?? null;
                        $author_amounts = @$us->data->author_numbers ?? null;
                        $position = @$us->data->position ?? null;
                        $articleArr = [];


                        if ($us->filter == 'international') {
                            if ($articleType == "NS") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 15), $scores['research']['article'], $scores_max['research']['article']);

                            } else if ($articleType == "Q1") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 7.5), $scores['research']['article'], $scores_max['research']['article']);

                            } else if ($articleType == "Q2") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 6), $scores['research']['article'], $scores_max['research']['article']);

                            } else if ($articleType == "Q3") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 3.75), $scores['research']['article'], $scores_max['research']['article']);

                            } else if ($articleType == "Q4") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 0.75), $scores['research']['article'], $scores_max['research']['article']);

                            }
                        } else if ($us->filter == 'science') {
                            $journal_title = Score::whereUserId($userId)->whereCert('research')->whereType('article')->whereFilter('science')->first()->data->journal_title;
                            $science_type = $this->check_article_science_title($journal_title);

                            if ($science_type == "1") {     //1->علمی پژوهشی
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 4.5), $scores['research']['article'], $scores_max['research']['article']);
                            } else if ($science_type == "2") {  //2->علمی ترویجی
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 0.75), $scores['research']['article'], $scores_max['research']['article']);
                            }
                        } else if ($us->filter == 'national') {
                            if ($presentaion == "سخنرانی") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 1.5), $scores['research']['article'], $scores_max['research']['article']);
                            } else if ($presentaion == "پوستر") {
                                $articleArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 0.75), $scores['research']['article'], $scores_max['research']['article']);
                            }
                        }


                        $scores['research']['article'] = 0;  //reset article score = 0
                        $scoreAllArticleArray[] = $articleArr;

                        foreach ($scoreAllArticleArray as $key => $articleArray) {
                            if (is_array($articleArray)) {
                                $scoreAllArticleArray[$key] = $articleArray[0];
                            }
                        }
                        $articleScore = $this->check_article_user_degree($scoreAllArticleArray, $user_degree);
                        $scores['research']['article'] += $articleScore;
                    }


                } else if ($us->type == "book") {

                    $bookYears = @$data->year ?? null;


                    if ($this->checked_8_years_ago($bookYears)) {
                        $participation = @$data->participation ?? null;
                        $author_amounts = @$data->author_numbers ?? null;
                        $publisher = @$data->publisher ?? null;  //if سایر else bmn
                        $position = @$data->position ?? null;
                        $book_unit = @$data->unit ?? null;
                        $bookArr = [];  //get book score


                        if ($us->data->selected_type == 'کتاب سال جمهوری اسلامی') {
                            if ($book_unit == "تالیف برگزیده") {
                                $bookArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 52.5), $scores['research']['book'], $scores_max['research']['book']);
                            } else if ($book_unit == "تالیف شایسته تقدیر") {
                                $bookArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 45), $scores['research']['book'], $scores_max['research']['book']);
                            } else if ($book_unit == "ترجمه برگزیده") {
                                $bookArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 26.25), $scores['research']['book'], $scores_max['research']['book']);
                            } else if ($book_unit == "ترجمه شایسته تقدیر") {
                                $bookArr[] += $this->addWithMax($this->authorRatio($author_amounts, $position, 22.5), $scores['research']['book'], $scores_max['research']['book']);
                            }

                        } else if ($us->data->selected_type == 'کتاب سال حوزه') {
                            $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 15), $scores['research']['book'], $scores_max['research']['book']);

                        } else if ($us->data->selected_type == 'هیچکدام') {
                            if ($participation == "نگارش کتاب کامل علمی") {
                                if ($publisher == "سایر") {
                                    $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 1.5), $scores['research']['book'], $scores_max['research']['book']);
                                } else {
                                    $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 15), $scores['research']['book'], $scores_max['research']['book']);
                                }

                            } else if ($participation == "نگارش فصل کتاب علمی") {
                                $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 3), $scores['research']['book'], $scores_max['research']['book']);
                            } else if ($participation == "ترجمه کتاب علمی") {
                                if ($publisher == "سایر") {
                                    $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 0.75), $scores['research']['book'], $scores_max['research']['book']);
                                } else {
                                    $bookArr[] += $this->addWithMaxBook($this->authorRatio($author_amounts, $position, 3.75), $scores['research']['book'], $scores_max['research']['book']);
                                }
                            }
                        }

                        $scores['research']['book'] = 0;  //reset book score 0
                        $scoreAllBookArray[] = $bookArr;

                        foreach ($scoreAllBookArray as $key => $bookArray) {
                            if (is_array($bookArray)) {
                                //$bookArray[0];  //0 => "7.50" -> مقدار امتیاز میگیره
                                $scoreAllBookArray[$key] = $bookArray[0];  //میاد مقدار ولیو هر آرایه میگیره میریزه درون scoreAllBookArray$ نه مقدار کلید یا شماره
                            }
                        }
                        $bookScore = $this->check_book_user_degree($scoreAllBookArray, $user_degree);
                        $scores['research']['book'] += $bookScore;

                        /*$flattenedArray = [];
                        foreach ($scoreAllBookArray as $bookArray) {
                            if (is_array($bookArray)) {
                                foreach ($bookArray as $value) {
                                    $flattenedArray[] = $value; // اضافه کردن مقدار به آرایه تک بعدی
                                }
                            }
                        }
                        $bookScore = $this->check_book_article_user_degree($flattenedArray, $user_degree);
                        $scores['research']['book'] += $bookScore;
                        */

                    }

                } else if ($us->type == "cooperation") {
                    $years = @$data->end_date ?? null;
                    if ($this->checked_8_years_ago($years)) {
                        $person_amounts = (int)@$data->person_amounts ?? null;
                        $position = (int)@$data->position ?? null;
                        $price = (int)@$data->price * 4 / (145 * 100 * 100 * 100) ?? null;
                        $scores['research']['cooperation'] += $this->addWithMax($this->authorRatio($person_amounts, $position, $price), $scores['research']['cooperation'], $scores_max['research']['cooperation']);
                    } else {
                        $scores['research']['cooperation'] += 0;
                    }
                }


            } else if ($us->cert == "skill") {
                $participation = floatval(@$data->participation) / 100;

                $date = @$data->date ?? null;
                $end_date = @$data->end_date ?? null;
                $year = @$data->year ?? null;
                $production_year = @$data->production_year ?? null;
                $best_amount = @$data->best_amount ?? null;

                if ($us->type == "babaei") {
                    if ($this->checked_8_years_ago($year)) {
                        $scores['skill']['babaei'] += $this->addWithMax(15, $scores['skill']['babaei'], $scores_max['skill']['babaei']);
                    }
                } /*else if ($us->type == "activities") {*/


                $d1 = strtotime(@$data->start_date);
                $d2 = strtotime(@$data->end_date);
                $months = 0;
                if ($d1 && $d2) {
                    $year1 = date('Y', $d1);
                    $year2 = date('Y', $d2);
                    $month1 = date('m', $d1);
                    $month2 = date('m', $d2);
                    $day1 = date('d', $d1);
                    $day2 = date('d', $d2);
                    $months = (($year2 - $year1) * 12) + ($month2 - $month1) + (($day2 - $day1) * (1 / 30));
                    $months = number_format((float)$months, 2, '.', '');
                }
                $hours_limit = min(intval(@$data->hour) ?? 0, 100);

                $hours = intval(@$data->hour) ?? 0;


                if ($us->type == "internship") {
                    if ($this->checked_8_years_ago($end_date)) {
                        $scores['skill']['internship'] += $this->addWithMax($this->skill_score(1, $months, [0.5, 0.5, 0.5]), $scores['skill']['internship'], $scores_max['skill']['internship']);
                    }

                } else if ($us->type == "skill_comp") {
                    if ($this->checked_8_years_ago($date)) {
                        $scores['skill']['skill_comp'] += $this->addWithMax($this->skill_score($rank, 1, [4.5, 3, 1.5]), $scores['skill']['skill_comp'], $scores_max['skill']['skill_comp']);
                    }

                } else if ($us->type == "knowledge") {
                    if ($this->checked_8_years_ago($production_year)) {
                        $scores['skill']['knowledge'] += $this->addWithMax($this->skill_score(1, $participation, [8, 8, 8]), $scores['skill']['knowledge'], $scores_max['skill']['knowledge']);
                    }

                } else if ($us->type == "certificate") {
                    if (@$data->type == "پایه") {
                        if ($this->checked_8_years_ago($end_date)) {
                            $scores['skill']['base_certificate'] += $this->addWithMax($this->skill_score(1, $hours_limit / 10, [0.3, 0.3, 0.3]), $scores['skill']['base_certificate'], $scores_max['skill']['base_certificate']);
                        }
                    } else if (@$data->type == "تخصصی") {
                        if ($this->checked_8_years_ago($end_date)) {
                            $scores['skill']['pro_certificate'] += $this->addWithMax($this->skill_score(1, $hours_limit / 10, [0.5, 0.5, 0.5]), $scores['skill']['pro_certificate'], $scores_max['skill']['pro_certificate']);
                        }
                    }

                } else if ($us->type == "experience") {
                    if ($this->checked_8_years_ago($end_date)) {
                        $scores['skill']['experience'] += $this->addWithMax($this->skill_score(1, $months, [0.3, 0.3, 0.3]), $scores['skill']['experience'], $scores_max['skill']['experience']);
                    }

                } else if ($us->type == "history") {

                    if (@$data->place == "تدریس در دانشگاه") {
                        if ($this->checked_8_years_ago($year)) {
                            $scores['skill']['history_uni'] += $this->addWithMax($this->skill_score(1, $hours / 17, [0.3, 0.3, 0.3]), $scores['skill']['history_uni'], $scores_max['skill']['history_uni']);
                        }

                    } else if (@$data->place == "تدریس خارج از دانشگاه") {
                        if ($this->checked_8_years_ago($year)) {
                            $scores['skill']['history_else'] += $this->addWithMax($this->skill_score(1, $hours / 17, [0.15, 0.15, 0.15]), $scores['skill']['history_else'], $scores_max['skill']['history_else']);
                        }
                    }

                } else if ($us->type == "postdoctor") {
                    if ($this->checked_8_years_ago($end_date)) {
                        $scores['skill']['postdoctor'] += $this->addWithMax($this->skill_score(1, $months, [0.8, 0.8, 0.8]), $scores['skill']['postdoctor'], $scores_max['skill']['postdoctor']);
                    }
                } else if ($us->type == "employment") {
                    if ($this->checked_8_years_ago($year)) {
                        $best_amount = $this->skill_employment_rank($best_amount);
                        $scores['skill']['employment'] += $this->addWithMax($this->skill_score($best_amount, 1, [4, 4.5, 5]), $scores['skill']['employment'], $scores_max['skill']['employment']);

                    }
                }
                /*}*/


            } else if ($us->cert == "technology") {
                $participation = floatval(@$data->participation) / 100;
                $edu_year = @$data->edu_year ?? null;
                $year = @$data->year ?? null;
                $approve_date = @$data->approve_date ?? null;
                $hours = intval(@$data->hour) ?? 0;


                if ($us->type == "assist") {
                    if ($this->checked_8_years_ago($edu_year)) {
                        $scores['technology']['assistant'] += $this->addWithMax($this->skill_score(1, $hours / 17, [0.3, 0.3, 0.3]), $scores['technology']['assistant'], $scores_max['technology']['assistant']);
                    }
                } else if ($us->type == "festival") {
                    $festival_levels = [
                        "دانش آموزی" => [21, 15, 6],
                        "دانشجویی و آزاد" => [36, 30, 24],
                        "بین المللی" => [105, 90, 75],

                        "محقق برگزیده" => [105, 90, 75],
                        "محقق جوان" => [36, 36, 36],
                        "محقق دانشجو" => [30, 30, 30],

                        "بزرگسال" => [105, 90, 75],
                        "جوان" => [36, 30, 24],

                        "طرح های سامانه ای" => [36, 30, 24],
                        "طرح های علمی و دانشی" => [36, 30, 24],
                        "طرح های محققین" => [36, 30, 24],
                        "طرح های فناورانه(طرح برتر)" => [36, 36, 36]
                    ];


                    $rankRatio = [0, 0, 0];
                    foreach ($festival_levels as $f => $ratio) {
                        if ($this->checked_8_years_ago($year)) {
                            if (@$data->level->name == "محقق برگزیده") $participation = 1;
                            if ($f == @$data->level->name) $rankRatio = $ratio;
                        }
                    }
                    if (@$data->level->name == "محقق جوان") {
                        if ($this->checked_8_years_ago($year)) {
                            $scores['technology']['festival'] += $this->addWithMax(36, $scores['technology']['festival'], $scores_max['technology']['festival']);
                        }
                    } else if (@$data->level->name == "محقق دانشجو") {
                        if ($this->checked_8_years_ago($year)) {
                            $scores['technology']['festival'] += $this->addWithMax(30, $scores['technology']['festival'], $scores_max['technology']['festival']);
                        }
                    } else {
                        if ($this->checked_8_years_ago($year)) {
                            $scores['technology']['festival'] += $this->addWithMax($this->skill_score($rank, floatval($participation), $rankRatio), $scores['technology']['festival'], $scores_max['technology']['festival']);
                        }
                    }
                } else if ($us->type == "comp") {

                    // $rank = floatval(@$data->rank);
                    if (@$data->title == "robocup") {
                        $section = @$data->unit;

                        if ($section == "دانش‌آموزی") {
                            if ($this->checked_8_years_ago($year)) {
                                return $scores['technology']['robocup'] += $this->addWithMax($this->skill_score($rank, floatval($participation), [10.5, 7.5, 4.5]), $scores['technology']['robocup'], $scores_max['technology']['robocup']);
                            }
                        } else if ($section == "دانشجویی") {
                            if ($this->checked_8_years_ago($year)) {
                                $scores['technology']['robocup'] += $this->addWithMax($this->skill_score($rank, floatval($participation), [18, 15, 12]), $scores['technology']['robocup'], $scores_max['technology']['robocup']);
                            }
                        }
                    } else if (@$data->title == "nano_uni") {
                        if ($this->checked_8_years_ago($year)) {
                            if ($rank <= 3) {
                                $scores['technology']['nano_uni'] += $this->addWithMax(18, $scores['technology']['nano_uni'], $scores_max['technology']['nano_uni']);
                            } else if ($rank <= 10) {
                                $scores['technology']['nano_uni'] += $this->addWithMax(6, $scores['technology']['nano_uni'], $scores_max['technology']['nano_uni']);
                            }
                        }
                    } else if (@$data->title == "nano_school") {
                        if ($this->checked_8_years_ago($year)) {
                            if ($rank == 1) {
                                $scores['technology']['nano_school'] += $this->addWithMax(21, $scores['technology']['nano_school'], $scores_max['technology']['nano_school']);
                            } else if ($rank == 2) {
                                $scores['technology']['nano_school'] += $this->addWithMax(15, $scores['technology']['nano_school'], $scores_max['technology']['nano_school']);
                            } else if ($rank == 3) {
                                $scores['technology']['nano_school'] += $this->addWithMax(9, $scores['technology']['nano_school'], $scores_max['technology']['nano_school']);
                            }
                        }
                        /*} else if ($us->filter == "tech") {
                            $scores['skill']['comp']['tech'] += $this->addWithMax($this->skill_score($rank, 1, [7.2, 6, 4.8]), $scores['skill']['comp']['tech'], $scores_max['skill']['comp']['tech']);*/
                    }
                } else if ($us->type == "invention") {
                    $level = $this->strToRank(@$data->level) ?? null;
                    if ($this->checked_8_years_ago($year)) {
                        $scores['technology']['invention'] += $this->addWithMax($this->skill_score($level, $participation, [30, 18, 9]), $scores['technology']['invention'], $scores_max['technology']['invention']);
                    }
                } else if ($us->type == "cooperation") {
                    if ($this->checked_8_years_ago($approve_date)) {
                        $person_amounts = (int)@$data->person_amounts ?? null;
                        $position = (int)@$data->position ?? null;
                        //$price = (int)@$data->price * 4 / (145 * 1000000) ?? null;
                        $price = (int)@$data->price * 4 / (145 * 100 * 100 * 100) ?? null;
                        $scores['technology']['cooperation'] += $this->addWithMax($this->authorRatio($person_amounts, $position, $price), $scores['technology']['cooperation'], $scores_max['technology']['cooperation']);
                    }
                } else if ($us->type == "ahmadi") {
                    if ($this->checked_8_years_ago($year)) {
                        $scores['technology']['ahmadi'] += $this->addWithMax(3, $scores['technology']['ahmadi'], $scores_max['technology']['ahmadi']);
                    }
                } else if ($us->type == "art") {
                    if ($this->checked_8_years_ago($year)) {
                        if (@$data->choise == "مستعد برتر") {
                            $scores['technology']['art_school'] += $this->addWithMax(5, $scores['technology']['art_school'], $scores_max['technology']['art_school']);
                        } else if (@$data->choise == "سرآمد") {
                            $scores['technology']['art_uni'] += $this->addWithMax(10, $scores['technology']['art_uni'], $scores_max['technology']['art_uni']);
                        }
                    }
                } else if ($us->type == "bahaei") {
                    if ($this->checked_8_years_ago($year)) {
                        $scores['technology']['bahaei'] += $this->addWithMax($this->skill_score($rank, 1, [10.8, 9, 7.2]), $scores['technology']['bahaei'], $scores_max['technology']['bahaei']);
                    }
                } else if ($us->type == "chosen") {
                    $comp_type = @$data->comp_type;
                    if ($this->checked_8_years_ago($year)) {
                        if ($comp_type == "ملی") {
                            $scores['technology']['chosen'] += $this->addWithMax($this->skill_score($rank, 1, [7.5, 4.5, 3]), $scores['technology']['chosen'], $scores_max['technology']['chosen']);
                        } else if ($comp_type == "بین المللی") {
                            $scores['technology']['chosen'] += $this->addWithMax($this->skill_score($rank, 1, [18, 12, 7.5]), $scores['technology']['chosen'], $scores_max['technology']['chosen']);
                        }
                    }
                }

            } else if ($us->cert == "culture") {
                $end_date = @$data->end_date ?? null;
                $type = @$data->type ?? null;  //type -> cultural -> همکاری + حضور


                $d1 = strtotime(@$data->start_date);
                $d2 = strtotime(@$data->end_date);
                $years = 0;
                if ($d1 && $d2) {
                    $year1 = date('Y', $d1);
                    $year2 = date('Y', $d2);
                    $month1 = date('m', $d1);
                    $month2 = date('m', $d2);
                    $day1 = date('d', $d1);
                    $day2 = date('d', $d2);
                    $years = ($year2 - $year1) + (($month2 - $month1) / 12) + (($day2 - $day1) * (1 / (30 * 12)));
                    $years = number_format((float)$years, 2, '.', '');
                }


                if ($this->checked_8_years_ago($end_date)) {

                    if ($us->type == "professional") {
                        $scores['culture']['professional'] += $this->addWithMax($years / 2, $scores['culture']['professional'], $scores_max['culture']['professional']);

                    } else if ($us->type == "cultural") {
                        if ($type == "حضور") {
                            $scores['culture']['cultural'] += $this->addWithMax(0.25, $scores['culture']['cultural'], $scores_max['culture']['cultural']);
                        } else if ($type == "همکاری") {
                            $scores['culture']['cultural'] += $this->addWithMax(0.5, $scores['culture']['cultural'], $scores_max['culture']['cultural']);
                        }

                    } else if ($us->type == "journals") {
                        $scores['culture']['journals'] += $this->addWithMax($years, $scores['culture']['journals'], $scores_max['culture']['journals']);

                    } else if ($us->type == "management") {
                        $scores['culture']['management'] += $this->addWithMax($years, $scores['culture']['management'], $scores_max['culture']['management']);
                    } else if ($us->type == "journals_head") {
                        $scores['culture']['journals_head'] += $this->addWithMax($years, $scores['culture']['journals_head'], $scores_max['culture']['journals_head']);
                    } else if ($us->type == "assoc_uni") {
//                    return Score::find(1194);
                        $scores['culture']['assoc_uni'] += $this->addWithMax($years, $scores['culture']['assoc_uni'], $scores_max['culture']['assoc_uni']);
                    } else if ($us->type == "camp") {
//                    return Score::find(1195);
                        $scores['culture']['camp'] += $this->addWithMax(1, $scores['culture']['camp'], $scores_max['culture']['camp']);
                    }

                }

            }
        }
        $scoresRes = [
            "training" => number_format((float)array_sum($scores['training']), 2, '.', ''),
            "research" => number_format((float)array_sum($scores['research']), 2, '.', ''),
            "skill" => number_format((float)array_sum($scores['skill']), 2, '.', ''),
            "technology" => number_format((float)array_sum($scores['technology']), 2, '.', ''),
            "culture" => $this->check_degree_culture(number_format((float)array_sum($scores['culture']), 2, '.', ''), $user_degree),
//          "culture" => number_format((float)array_sum($scores['culture']), 2, '.', ''),
        ];
        if ($allScore) return number_format((float)array_sum($scoresRes), 2, '.', '');

//      return $scoresRes;
        foreach ($scores as $s) {
            if (gettype($s) == "array") {
                foreach ($s as $i) {
                    if (gettype($i) == "array") {
                        foreach ($i as $ii) {
                            $score += $ii;
                        }
                    } else {
                        $score += $i;
                    }
                }
            } else {
                $score += $s;
            }
        }
        return $data = ["all_scores" => number_format((float)array_sum($scoresRes), 2, '.', ''), "scores" => $scores, "scoresRes" => $scoresRes];
    }

    public
    function strToRank($str)
    {
        if (in_array($str, ["3 شایستگی", "سطح 1", "طلا", "اول", "رتبه اول", "1"])) return 1;
        else if (in_array($str, ["4 شایستگی", "سطح 2", "نقره", "دوم", "رتبه دوم", "2"])) return 2;
        else if (in_array($str, ["بیشتر از 4 شایستگی", "سطح 3", "برنز", "سوم", "رتبه سوم", "3"])) return 3;
        else if (in_array($str, ["چهارم", "رتبه چهارم", "4"])) return 4;
        else if (in_array($str, ["پنجم", "رتبه پنجم", "5"])) return 5;
        else if (in_array($str, ["ششم", "رتبه ششم", "6"])) return 6;
        else if (in_array($str, ["هفتم", "رتبه هفتم", "7"])) return 7;
        else if (in_array($str, ["هشتم", "رتبه هشتم", "8"])) return 8;
        else if (in_array($str, ["نهم", "رتبه نهم", "9"])) return 9;
        else if (in_array($str, ["دهم", "رتبه دهم", "10"])) return 10;
        else if (intval($str > 10)) return floatval($str);
    }

    public
    function olympiad_scoreBased_bmp($user_degree, $gg)
    {
        $b = $gg[0];
        $m = $gg[1];
        $p = $gg[2];
        if ($user_degree == "bachelor" || $user_degree == "mullah3") return $b;
        else if ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") return $m;
        else if ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") return $p;
        return 0;
    }

    public function olympiad_scoreBased_rank($user_degree, $rank, $g)
    {
        //[[24.75, 13.5, 9], [18.75, 10.5, 6], [11.25, 9, 4.5]]  //[[0,1,2],[0,1,2],[0,1,2]]
        if ($rank == 1) return $this->olympiad_scoreBased_bmp($user_degree, $g[$rank - 1]);      //$user_degree, $g[$rank - 1] -> array[0][0]
        else if ($rank == 2) return $this->olympiad_scoreBased_bmp($user_degree, $g[$rank - 1]); //$user_degree, $g[$rank - 1] -> array[1][1]
        else if ($rank == 3) return $this->olympiad_scoreBased_bmp($user_degree, $g[$rank - 1]); //$user_degree, $g[$rank - 1] -> array[2][2]
        return 0;
    }

    public function addWithMax($add, $score, $max)
    {
        $remained = $max - $score;
        if ($add > $remained) return $remained;
        return number_format((float)$add, 2, '.', '');
    }


    public function addWithMaxBook($add, $score, $max)
    {
        $max = 15;
        $remained = $max - $score;
        if ($add > $remained) return $remained;
        return number_format((float)$add, 2, '.', '');
    }

    public function medical_score($rank, $user_degree)
    {
        if ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") return 0.1 * (220 - (20 * $rank));
        else if ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") return 0.1 * (110 - (10 * $rank));
        return 0;
    }

    public function entrance_score($rank, $user_degree)
    {
        if ($user_degree == "bachelor" || $user_degree == "mullah3") return 0.015 * (1001 - $rank);
        else if ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") return 0.012 * (1001 - $rank);
        else if ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") return 0.01 * (1001 - $rank);
        return 0;
    }

    public function sample_score($user_degree)
    {
        if ($user_degree == "bachelor" || $user_degree == "pro_doctor" || $user_degree == "mullah3") return 4.5;
        else if ($user_degree == "master" || $user_degree == "con_master" || $user_degree == "mullah4") return 6;
        else if ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") return 7.5;
        return 0;
    }

    public function math_score($rank)
    {
        if ($rank == 1) return 15;
        else if ($rank == 2) return 7.5;
        else if ($rank == 3) return 3.75;
        return 0;
    }

    public function skill_score($rank, $participation, $rankRatio)
    {
        if ($rank == 1) return $rankRatio[0] * $participation;  //skills[internship] -> months * 0.5
        else if ($rank == 2) return $rankRatio[1] * $participation;
        else if ($rank == 3) return $rankRatio[2] * $participation;
        return 0;
    }

    public function skill_employment_rank($best_amount)
    {
        if ($best_amount == 3) return 1;
        elseif ($best_amount == 4) return 2;
        elseif ($best_amount > 4) return 3;
        return 0;
    }

    public function check_degree_culture($data, $user_degree)
    {
        if ($user_degree == "bachelor" || $user_degree == "mullah3") return min($data, "3.5");
        else if ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") return min($data, "4");
        else if ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") return min($data, "5");
        return $data = "0";
    }


    public function check_book_user_degree($book, $user_degree)
    {
        if ($user_degree == "bachelor" || $user_degree == "mullah3") {
            $max = 1;
        } elseif ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") {
            $max = 2;
        } elseif ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") {
            $max = 5;
        } else {
            $max = 0;
        }
//      $max = min($max, count($book));
        $max = min(count($book), $max);
        rsort($book);
        $selectedScores = array_slice($book, 0, $max);  //get count(user degree)
        return array_sum($selectedScores);
    }

    public function check_article_user_degree($article, $user_degree)
    {
        if ($user_degree == "bachelor" || $user_degree == "mullah3") {
            $max = 2;
        } elseif ($user_degree == "master" || $user_degree == "pro_doctor" || $user_degree == "con_master" || $user_degree == "mullah4") {
            $max = 5;
        } elseif ($user_degree == "phd" || $user_degree == "con_specialist_phd" || $user_degree == "con_phd" || $user_degree == "mullah_second_term") {
            $max = 10;
        } else {
            $max = 0;
        }

        $max = min(count($article), $max);
        rsort($article);
        $selectedScores = array_slice($article, 0, $max);
        return array_sum($selectedScores);
    }

    public function check_article_science_title($science_type)
    {
        return $journals = Journal::query()->whereBetween('is_internal', [0, 2])->where('name', $science_type)->first()->internal_rank;
    }


    public function major_coefficients_with_univercity($user_degree, $bachelor = null, $master = null, $phd = null)
    {


        if ($user_degree == "bachelor" || $user_degree == "mullah3") {
            $university = $bachelor->data->university;
            $major = $bachelor->data->major;
            $bachelor_gpa = $bachelor ? floatval($bachelor->data->gpa) : 0;

            $major_coefficient = MajorCoefficients::query()
                ->where('university', $university)
                ->where('major', $major)
                ->first();
            if (!is_null($major_coefficient)) {
                $bachelor_major_gpa = $major_coefficient->bachelor * $bachelor_gpa;
                return $bachelor = max(0, 0.15 * (floatval($bachelor_major_gpa) - 12) * 23);//If zero or less than zero = 0
            } else {
                return $bachelor = max(0, 0.15 * (floatval($bachelor_gpa) - 12) * 23);//If zero or less than zero = 0
            };


        } elseif ($user_degree == "master" || $user_degree == "mullah4") {

            $bachelor_university = $bachelor->data->university;
            $bachelor_major = $bachelor->data->major;
            $bachelor_gpa = $bachelor ? floatval($bachelor->data->gpa) : 0;

            $major_coefficient_bachelor = MajorCoefficients::query()
                ->where('university', $bachelor_university)
                ->where('major', $bachelor_major)
                ->first();

            $master_university = $master->data->university;
            $master_major = $master->data->major;
            $master_gpa = $master ? floatval($master->data->gpa) : 0;

            $major_coefficient_master = MajorCoefficients::query()
                ->where('university', $master_university)
                ->where('major', $master_major)
                ->first();


            if (!is_null($major_coefficient_bachelor) && !is_null($major_coefficient_master)) {
                $bachelor_major_gpa = $major_coefficient_bachelor->bachelor * $bachelor_gpa;
                $master_major_gpa = $major_coefficient_master->master * $master_gpa;
                return $master = max(0, 0.15 * (((floatval($master_major_gpa) - 14) * 22) + (($bachelor_major_gpa - 12) * 11)));//If zero or less than zero = 0
            } else {
                return $master = max(0, 0.15 * (((floatval($master_gpa) - 14) * 22) + (($bachelor_gpa - 12) * 11)));//If zero or less than zero = 0
            };


        } elseif ($user_degree == "pro_doctor" || $user_degree == "con_master") {

            $pro_doctor_university = $master->data->university;
            $pro_doctor_major = $master->data->major;
            $pro_doctor_gpa = $master ? floatval($master->data->gpa) : 0;

            $major_coefficient_pro_doctor = MajorCoefficients::query()
                ->where('university', $pro_doctor_university)
                ->where('major', $pro_doctor_major)
                ->first();

            if (!is_null($major_coefficient_pro_doctor)) {
                $pro_doctor_major_gpa = $major_coefficient_pro_doctor->master * $pro_doctor_gpa;
                return $pro_doctor = max(0, 0.15 * (floatval($pro_doctor_major_gpa) - 12) * 25);//If zero or less than zero = 0
            } else {
                return $pro_doctor = max(0, 0.15 * (floatval($pro_doctor_gpa) - 12) * 25);//If zero or less than zero = 0
            };

        } elseif ($user_degree == "phd") {
            if ($bachelor) {
                $bachelor_university = $bachelor->data->university;
                $bachelor_major = $bachelor->data->major;
                $bachelor_gpa = $bachelor ? floatval($bachelor->data->gpa) : 0;
                $major_coefficient_bachelor = MajorCoefficients::
                where('university', $bachelor_university)
                    ->where('major', $bachelor_major)
                    ->first();
            }

            $master_university = $master->data->university;
            $master_major = $master->data->major;
            $master_gpa = $master ? floatval($master->data->gpa) : 0;
            $major_coefficient_master = MajorCoefficients::
            where('university', $master_university)
                ->where('major', $master_major)
                ->first();

            $con_master_university = $master->data->university;
            $con_master_major = $master->data->major;
            $con_master_gpa = $master ? floatval($master->data->gpa) : 0;
            $major_coefficient_con_master = MajorCoefficients::
            where('university', $con_master_university)
                ->where('major', $con_master_major)
                ->first();

            $phd_university = $phd->data->university;
            $phd_major = $phd->data->major;
            $phd_gpa = $phd ? floatval($phd->data->gpa) : 0;
            $major_coefficient_phd = MajorCoefficients::query()
                ->where('university', $phd_university)
                ->where('major', $phd_major)
                ->first();


            if (!is_null($bachelor) && !is_null($master)) {
                if (!is_null($major_coefficient_bachelor) && !is_null($major_coefficient_master) && !is_null($major_coefficient_phd)) {
                    $bachelor_major_gpa = $major_coefficient_bachelor->bachelor * $bachelor_gpa;
                    $master_major_gpa = $major_coefficient_master->master * $master_gpa;
                    $phd_major_gpa = $major_coefficient_phd->phd * $phd_gpa;
                    return $phd = max(0, 0.15 * (((floatval($phd_major_gpa) - 16) * 41) + (($master_major_gpa - 14) * 18) + (($bachelor_major_gpa - 12) * 6)));
                } else {
                    return $phd = max(0, 0.15 * (((floatval($phd_gpa) - 16) * 41) + (($master_gpa - 14) * 18) + (($bachelor_gpa - 12) * 6)));//If zero or less than zero = 0
                }

            } else if (!is_null($master)) {
                if (!is_null($major_coefficient_con_master) && !is_null($major_coefficient_phd)) {
                    $master_major_gpa = $major_coefficient_con_master->master * $con_master_gpa;
                    $phd_major_gpa = $major_coefficient_phd->phd * $phd_gpa;
                    return $con_master = 0.15 * ((floatval($phd_major_gpa) - 16) * 30) + (($master_major_gpa - 12) * 17);
                } else {
                    return $con_master = max(0, 0.15 * ((floatval($phd_gpa) - 16) * 30) + (($con_master_gpa - 12) * 17));//If zero or less than zero = 0

                }

            }

        } elseif ($user_degree == "mullah_second_term") {
            $mullah3_university = $bachelor->data->university;
            $mullah3_major = $bachelor->data->major;
            $mullah3_gpa = $bachelor ? floatval($bachelor->data->gpa) : 0;
            $major_coefficient_mullah3 = MajorCoefficients::where('university', $mullah3_university)
                ->where('major', $mullah3_major)
                ->first();

            $mullah4_university = $master->data->university;
            $mullah4_major = $master->data->major;
            $mullah4_gpa = $master ? floatval($master->data->gpa) : 0;
            $major_coefficient_mullah4 = MajorCoefficients::where('university', $mullah4_university)
                ->where('major', $mullah4_major)
                ->first();

            $mullah_second_term_university = $phd->data->university;
            $mullah_second_term_major = $phd->data->major;
            $mullah_second_term_gpa = $phd ? floatval($phd->data->gpa) : 0;
            $major_coefficient_mullah_second_term = MajorCoefficients::where('university', $mullah_second_term_university)
                ->where('major', $mullah_second_term_major)
                ->first();

            if (!is_null($major_coefficient_mullah3) && !is_null($major_coefficient_mullah4) && !is_null($major_coefficient_mullah_second_term)) {
                $mullah3_major_gpa = $major_coefficient_mullah3->bachelor * $mullah3_gpa;
                $mullah4_major_gpa = $major_coefficient_mullah4->master * $mullah4_gpa;
                $mullah_second_term_major_gpa = $major_coefficient_mullah_second_term->phd * $mullah_second_term_gpa;
                return $mullah_second_term = max(0, 0.15 * (((floatval($mullah_second_term_major_gpa) - 16) * 41) + (($mullah4_major_gpa - 14) * 18) + (($mullah3_major_gpa - 12) * 6)));

            } else {
                return $mullah_second_term = max(0, 0.15 * (((floatval($mullah_second_term_gpa) - 16) * 41) + (($mullah4_gpa - 14) * 18) + (($mullah3_gpa - 12) * 6)));
            }
        }

    }





    /*public function checkCanUploadArticle($userId, $user_degree)
    {
        $max = 0;
        $scoresCount = Score::whereUserId($userId)->whereCert('research')->whereType('article')->get()->count();
        // dd($scoresCount);
        if ($user_degree == "bachelor") $max = 2;
        else if ($user_degree == "master") $max = 5;
        else if ($user_degree == "phd") $max = 10;

        if ($scoresCount < $max) return true;
        return false;
    }*/

    /*public function checkCanUploadBook($userId, $user_degree)
    {
        $max = 0;
        $scoresCount = Score::whereUserId($userId)->whereCert('research')->whereType('book')->get()->count();
        if ($user_degree == "bachelor") $max = 1;
        else if ($user_degree == "master") $max = 2;
        else if ($user_degree == "phd") $max = 5;

        if ($scoresCount < $max) return true;
        return false;
    }*/

    public
    function authorRatio($author_amounts, $position, $ratio)
    {
        if ($position == "اول")
            $p = 0;
        else if ($position == 'بقیه همکاران')
            $p = 1;
        else
            $p = 0;
        if ($author_amounts > 6) $author_amounts = 6;
        //[بقیه همکاران,اول]
        $author_ratios = [
            [1, 0],
            [0.9, 0.6],
            [0.8, 0.5],
            [0.7, 0.4],
            [0.6, 0.3],
            [0.5, 0.25],
        ];
        $a = $author_amounts - 1;
        if ($a == -1) $a = 0;
        $res = $author_ratios[$a][$p] * $ratio;
        return number_format((float)$res, 2, '.', '');
    }


    public function checked_8_years_ago($date)
    {
        $endData = substr($date, 0, 4);
        $startData = 1402 - 8;
        if ($endData >= $startData) return true;
        return false;
    }

// public function getScoreStatus($id , Request $req){
//     $score = Score::whereId($id)->whereUserId($req->user()->id)->get();
//     $invalidDegree = ($cert == "training" && $type == "edu") ? false : $this->invalidDegree($req->user()->id);
//     if ($invalidDegree) return $this->errorHttpUser([], $invalidDegree, 403);
//     return $this->successHttpUser(ScoreResource::collection($score), "امتیازات کاربر دریافت شد");
// }


    public function sendUserCase(Request $req)
    {
        $userId = $req->user()->id;
        $caseBefore = InojobCases::where('user_id', $userId)->first();
        $userScore = $this->updateUserScore($req, true);

        if ($caseBefore) {

            $case->update([
                "user_id" => $userId,
                "status" => 3,
                "step" => 1,
                "score" => $userScore
            ]);
            $user_inojob = $req->user()->inojob;
            $user_inojob->personal_status = 5;
            $user_inojob->priority_status = 5;

            $req->user()->update([
                "inojob" => $user_inojob
            ]);
            Score::whereUserId($userId)->whereStatus(3)->update(['status' => 5]);
            return $case;
        };

        $case = InojobCases::create([
            "user_id" => $userId,
            "status" => 1,
            "step" => 1,
            "score" => $userScore
        ]);
        $user_inojob = $req->user()->inojob;
        $user_inojob->personal_status = 1.;
        $user_inojob->priority_status = 1.;
        Score::whereUserId($userId)->whereStatus(0)->update(['status' => 1]);
        $req->user()->update([
            "inojob" => $user_inojob
        ]);
        return $case;
    }


//-------------------- get score info with (table=#scores)
    public
    function getScoreInfo()
    {
        $scoreInfo = ScoreInfo::all();
        $scoreInfoResource = ScoreInfoResource::collection($scoreInfo);
        return $this->successHttpUser($scoreInfoResource, "اطلاعات فرم دریافت شد");
    }


    public
    function getCertScoreInfo($cert)
    {
        $scoreInfo = ScoreInfo::where('cert', $cert)->latest()->get();
        $scoreInfoResource = ScoreInfoResource::collection($scoreInfo);
        return $this->successHttpUser($scoreInfoResource, "اطلاعات فرم براساس دسته بندی دریافت شد");
    }

    public
    function getCertTypeScoreInfo($cert, $type)
    {
        $scoreInfo = ScoreInfo::where('cert', $cert)->where('type', $type)->latest()->get();
        $scoreInfoResource = ScoreInfoResource::collection($scoreInfo);
        return $this->successHttpUser($scoreInfoResource, "اطلاعات فرم براساس زیر دسته دریافت شد");
    }

    public
    function getCertTypeFilterScoreInfo($cert, $type, $filter)
    {
        $scoreInfo = ScoreInfo::where('cert', $cert)->where('type', $type)->where('filter', $filter)->latest()->get();
        $scoreInfoResource = ScoreInfoResource::collection($scoreInfo);
        return $this->successHttpUser($scoreInfoResource, "اطلاعات فرم براساس فیلتر دریافت شد");
    }


    public
    function storeScoreInfo(Request $req)
    {
        $scoreDesc = ScoreInfo::create([
            'cert' => $req->cert,
            'type' => $req->type,
            'filter' => $req->filter,
            "data" => $req->data,
        ]);
        return $this->successHttpUser($scoreDesc, "اطلاعات فرم با موفقیت ایجاد شد");
    }

    public
    function updateScoreInfo(Request $req, ScoreInfo $scoreInfo)
    {
        $scoreInfo->update([
            'cert' => $req->cert,
            'type' => $req->type,
            'filter' => $req->filter,
            "data" => $req->data,
        ]);
        return $this->successHttpUser($scoreInfo, "اطلاعات فرم با موفقیت ویرایش شد");
    }


}
