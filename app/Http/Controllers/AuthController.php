<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\CodeEmailMail;
use App\Models\City;
use App\Models\Code;
use App\Models\CodeEmail;
use App\Models\Province;
use App\Models\User;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


// Traits
use App\Traits\auth\AuthRegister;
use App\Traits\auth\AuthSendCode;
use App\Traits\auth\AuthGetCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthGetCode, AuthSendCode, AuthRegister;

    public function faToEn($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public function login($code = null, $user, $msg = null, $http_code = 200)
    {
        if ($code) $code->delete();
        // if (!Auth::login($user)) return $this->errorCode('', 'عدم دسترسی', 401);
        return $this->successCode([
            'user' => $user,
            'token' => $user->createToken("API Token For Mobile : {$user->first_name} {$user->last_name}")->plainTextToken
        ], $msg, $http_code);
    }

    public function loginEmail($codeEmail = null, $user, $msg = null, $http_code = 200)
    {
        if ($codeEmail) $codeEmail->delete();

        return $this->successCode([
            'user' => $user,
            'token' => $user->createToken("API TOKEN For Email : {$user->first_name}")->plainTextToken
        ], $msg, $http_code);
    }


    //-------------------- get code with phone,email
    public function getCode(StoreUserRequest $req)
    {
        // *** TEMPORARY ***
        if ($req->has('phone')) {

            $user = User::wherePhone($req->phone)->first();
            if (is_null($user)) {
                return $this->errorCode([], "ثبت نام سایت تا اطلاع ثانویه بسته شده است", 401);
            }


            $req->validated($req->all());
            $code = Code::wherePhone($req->phone)->first();
            if (is_null($code) || @$code->expire < Carbon::now()) {
                $otp = rand(1000, 9999);
                if (is_null($code)) {
                    $code = Code::create([
                        'phone' => $this->faToEn($req->phone),
                        'code' => $otp,
                        'expire' => Carbon::now()->addMinutes(2)
                    ]);
                } else {
                    $code->update(['expire' => Carbon::now()->addMinutes(2)]);
                }

                if (!$req->has('no_code')) {
                    $client = new Client(["verify" => false]);
                    $client->request('POST', 'https://api.kavenegar.com/v1/39536341644734446C74443149444873694F51706D68464567725679564F456E2F374A46315273394B57413D/verify/lookup.json', [
                        'form_params' => [
                            'receptor' => $code->phone,
                            'token' => $code->code,
                            'template' => 'login',
                        ]
                    ]);
                }
                return $this->successGetCode(['expire' => $code->expire, "now" => Carbon::now()], "کد یکبار مصرف ارسال شد");
            }
            return $this->errorGetCode(['expire' => $code->expire, "now" => Carbon::now()], "لطفا صبر کنید", 429);


        } else if ($req->has('email')) {

            $codeEmail = CodeEmail::where('email', $req->email)->first();
            if (is_null($codeEmail) || @$codeEmail->expire < Carbon::now()) {
                $otp = rand(1000, 9999);
                if (is_null($codeEmail)) {
                    $codeEmail = CodeEmail::create([
                        'email' => $req->email,
                        'code' => $otp,
                        'expire' => Carbon::now()->addMinutes(2)
                    ]);
                    Mail::to($req->email)->send(new CodeEmailMail($otp));

                } else {
                    $codeEmail->update(['expire' => Carbon::now()->addMinutes(2)]);
                }

                return $this->successGetCode(['expire' => $codeEmail->expire, "now" => Carbon::now()], "کد یکبار مصرف ارسال شد");
            }
            return $this->errorGetCode(['expire' => $codeEmail->expire, "now" => Carbon::now()], "لطفا صبر کنید", 429);
        }

    }


    //-------------------- send code with phone,email
    public function sendCode(Request $req)
    {
        // $req->validated($req->all());

        if ($req->has('phone')) {

            $code = Code::wherePhone($req->phone)->first();
            // return $code;
            if ($code == '0000' || $req->code == '0000') {
                if ($req->user()) {
                    return "here";
                    if ($req->user()->is_admin == 1) {
                        $user = User::wherePhone($req->phone)->first();
                        return $this->login(null, $user);
                    }
                }
            }
            $codeValidated = false;
            if (!is_null($code)) $codeValidated = $req->code == $code->code;
            if ($codeValidated) {
                $user = User::wherePhone($req->phone)->first();
                if (is_null($user)) {
                    return $this->errorCode([], "ثبت نام سایت تا اطلاع ثانویه بسته شده است", 401);
                    /*$user = User::create([
                        'phone' => $req->phone,
                    ]);
                    return $this->login($code, $user, 'خوش آمدید', 201);
                    */
                }
                return $this->login($code, $user);
            }
            return $this->errorCode([], "کد وارد شده اشتباه است", 401);


        } else if ($req->has('email')) {
            $codeEmail = CodeEmail::whereEmail($req->email)->first();

            $codeEmailValidated = false;
            if (!is_null($codeEmail)) $codeEmailValidated = $req->code == $codeEmail->code;

            if ($codeEmailValidated) {
                $user = User::whereEmail($req->email)->first();
                if (is_null($user)) {
                    $user = User::create([
                        'email' => $req->email,
                    ]);
                    return $this->loginEmail($codeEmail, $user, 'خوش آمدید', 201);
                }
                return $this->loginEmail($codeEmail, $user);
            }
            return $this->errorCode([], "کد وارد شده اشتباه است", 401);
        }

    }

    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        return "خارج شدید";
    }
}
