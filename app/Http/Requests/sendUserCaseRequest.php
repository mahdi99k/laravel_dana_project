<?php

namespace App\Http\Requests;

use App\Traits\HttpData;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class sendUserCaseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'profile' => 'required|string',
            'bio' => 'required|string',
            'birthday' => 'required|string',
            'email' => "required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
            'phone' => 'required|numeric',
            'father' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'marital' => 'required|string|max:255',
            'military' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'shaba' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_card1' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'id_card2' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'id_card3' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'melli_card' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'military_card' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'personal' => 'required|image|mimes:jpg,png,pdf,webp,jpeg|max:500',
            'melli_code' => 'required|string|max:255',
            'melli_serial' => 'required|string|max:255',
            'melli_city' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'postal' => 'required|string|max:255',
            'more_city' => 'required|string|max:255',
            'address' => 'required|string',
            'job_title' => 'required|string',
            'job_company' => 'required|string',
            'job_phone' => 'required|numeric',
            'job_address' => 'required|string',
        ];

    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => [],
            ], 422)
        );
    }


    public function messages()
    {
        return [
            'first_name.required' => 'نام',
            'last_name.required' => 'نام خانوادگی',
            'username.required' => 'نام کاربری',
            'profile.required' => 'پروفایل',
            'bio.required' => 'بیوگرافی',
            'birthday.required' => 'تاریخ تولد',
            'email.required' => 'ایمیل',
            'email.regex' => 'درون ایمیل نباید از حروف فارسی استفاده شود',
            'phone.required' => 'شماره همراه',
            'father.required' => 'نام پدر',
            'gender.required' => 'جنسیت',
            'marital.required' => 'ازدواج',
            'military.required' => 'نظامی',
            'province.required' => 'استان',
            'shaba.required' => 'شبا',
            'telephone.required' => 'تلفن منزل',
            'type.required' => 'نوع',
            'id_card1.required' => 'تصویر صفحه اول شناسنامه',
            'id_card2.required' => 'تصویر صفحه وضعیت تاهل شناسنامه',
            'id_card3.required' => 'تصویر صفحه توضیحات شناسنامه',
            'melli_card.required' => 'کارت ملی',
            'military_card.required' => 'کارت پایان خدمت',
            'personal.required' => 'تصویر پرسنلی',
            'melli_code.required' => 'شماره شناسنامه',
            'melli_serial.required' => 'سریال شناسنامه',
            'melli_city.required' => 'محل صدور شناسنامه',
            'nationality.required' => 'تابعیت',
            'postal.required' => 'کد پستی',
            'more_city.required' => 'محل سکونت',
            'address.required' => 'آدرس',
            'job_title.required' => 'عنوان شغل',
            'job_company.required' => 'عنوان محل کار',
            'job_phone.required' => 'تلفن محل کار',
            'job_address.required' => 'آدرس محل کار',
        ];
    }

}
