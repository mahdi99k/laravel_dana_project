@extends('layouts2')
@section('customStyle')
<style>
    header {
        background-color: #000;
        position: relative;
        z-index: 0;
        height: 600px;

    }

    .hero-bg {
        opacity: 0.6;
        left: -200px;
        height: 100%;
        background-image: url(/assets/img/main/khamenei.webp);
        background-size: 100% 100%;
        aspect-ratio: 2500 / 1080;
        background-repeat: no-repeat;
        position: absolute;
        z-index: -1;
    }

    .hero {
        padding-top: 150px;
    }

    .hero .intro-img {
        width: 200px;
    }

    .hero .hero-img {
        width: 50%;
        padding: 40px 0;
        max-width: 1400px;
    }

    .hero-container {
        min-height: 280px;
    }

    @media only screen and (min-width: 1500px) {
        .hero-bg {
            left: 0;
        }
    }

    @media only screen and (min-width: 1200px) {
        header {
            height: 800px;
        }

    }

    @media only screen and (min-width: 992px) {
        .hero-bg {
            left: -260px;
        }

    }

    @media only screen and (max-width: 700px) {
        .hero-bg {
            left: -95px;
        }

        header {
            height: 300px;
        }

        .hero-container {
            min-height: 220px;
            max-width: 50%;
            padding-right: 15px;
        }

        .hero {
            padding-top: 30px;
        }

        .hero .intro-img {
            width: 120px;
        }

        .hero h2 {
            font-size: 1rem;
        }

        .hero .btn {
            font-size: 0.7rem;
        }

        .hero .hero-img {
            width: unset;
        }

    }

    @media only screen and (max-width: 568px) {
        header {
            height: 210px;
        }

        .hero-bg {
            left: -70px;
        }

        .hero-container {
            min-height: 150px;
            max-width: 60%;
        }

        .hero .intro-img {
            width: 60px;
        }

        .hero h2 {
            font-size: 0.9rem;
        }

        .hero .btn {
            font-size: 0.6rem;
        }

        .hero .hero-img {
            padding: 10px 0;
        }
    }

    .inovent-title {
        position: relative;
    }

    .inovent-title::before {
        content: "";
        background-image: url('/assets/img/barg-white.svg');
        position: absolute;
        background-size: 100% 100%;
        right: -13px;
        width: 23px;
        top: -5px;
        height: 40px;
    }

    .inovent-time-items {
        padding-right: 20px;
        padding-top: 20px;
    }

    .inovent-time-items::before {
        content: "";
        background-image: url('/assets/img/barg-line.svg');
        background-size: cover;
        width: 40px;
        position: absolute;
        right: -30px;
        height: 100%;
        top: 10px
    }

    .line-height-30 {
        line-height: 30px;
    }

    @media only screen and (min-width: 992px) {
        .hero-bg {
            left: -260px;
        }

        .fs-lg-6 {
            font-size: 1rem !important;
        }

        .fs-lg-3 {
            font-size: calc(1.3rem + .6vw) !important;
        }

        .inovent-title::before {
            content: "";
            background-image: url('/assets/img/barg-white.svg');
            position: absolute;
            background-size: cover;
            right: -40px;
            width: 33px;
            top: -10px;
            height: 50px;
        }

        .btn-con>div {
            justify-content: start !important;
        }

        .hero .hero-img {
            width: 50%;
            padding: 40px 0;
            max-width: 1400px;
        }
    }
</style>
@endsection
@section('mainCon')
<header class="dir-rtl overflow-hidden col-11 mx-auto my-5 rounded-4">
    <div class="hero-bg">

    </div>
    <div class="hero px-lg-5 px-2 pb-2 pb-sm-5 h-100">
        <div class="hero-container d-flex flex-column justify-content-between">
            <img src="/assets/img/main/hero-intro.svg" class="intro-img">

            <img src="/assets/img/main/hero-title.png" class="hero-img">
            <div class="d-flex">
                <a aria-label="inova-page" href="#about" class="text-decoration-none py-2 text-white btn btn-outline-primary btn-blue rounded-pill">
                    <img src="/assets/img/main/dropdown.svg" alt="توضحیحات بیشتر" width="25px" height="25px">

                    توضیحات بیشتر
                </a>
            </div>
        </div>
    </div>
</header>
<main class="dir-rtl">
    <div class="row col-11 mx-auto g-4">
        <div class="col-lg-9 col-12">
            <h1 class="inovent-title fs-lg-3 fs-6 f2-bold ps-3">
                {{ $inovent->title }}
            </h1>
            <div class="d-flex justify-content-between col-lg-8 col-md-10 col-12">
                <div class="d-flex align-items-center">
                    <img src="/assets/img/major-icon.svg" class="me-2" alt="major icon">
                    <span class="d-flex fs-7 fs-lg-6 text-ex-bold text-gray text-ex-bold">
                        <span class="d-none d-lg-block me-1">رشته: </span>
                        تمامی رشته ها
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <img src="/assets/img/calender-icon.svg" class="me-2" alt="time icon">
                    <span class="d-flex fs-7 fs-lg-6 text-ex-bold text-gray text-ex-bold">
                        <span class="d-none d-lg-block me-1">زمان برگزاری: </span>
                        هفته چهارم مهر
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <img src="/assets/img/user-gray.svg" class="me-2" alt="user icon">
                    <span class="d-flex fs-7 fs-lg-6 text-ex-bold text-gray text-ex-bold">
                        <span class="d-none d-lg-block me-1">نوع رویداد: </span>
                        حضوری
                    </span>
                </div>
            </div>
            <h2 class="mt-3 mb-2" id="about">
                توضیحات
            </h2>
            <div>
                <p class="text-gray fs-lg-6 fs-7 text-justify p-3 line-height-30">
                    ⚪
                    سیزدهمین همایش ملی نخبگان با شعار
                    «نخبگان، پیشران پیشرفت»
                    در هفته چهارم مهر ماه سال جاری برگزار می‌شود.
                    این همایش دو روزه به منظور ارتباط نخبگان و استعداد‌های برتر با مسئولان عالی نظام و ایجاد فرصتی برای هم‌اندیشی بین نخبگان برگزار خواهد شد.
                    در روز دوم این همایش، نخبگان و استعدادهای برتر به دیدار مقام معظم رهبری (مدظله العالی) خواهند رفت و ضمن ارائه نقطه نظرات خود از بیانات معظم له، بهره‌مند خواهند شد.
                    متقاضیان سخنرانی در محضر مقام معظم رهبری (مدظله العالی) می‌توانند متن پیشنهادی خود را تا تاریخ 18 شهریور بارگذاری نمایند.
                </p>
                <p class="text-gray fs-lg-6 fs-7 text-justify p-3 line-height-30">
                    ⚪
                    با توجه به محدودیت تعداد نفرات شرکت‌کننده در این دیدار، ثبت نام اولیه انجام و در مراحل بعد افرادی به تنوع رشته، مقطع، جنسیت، محل سکونت و... برای شرکت در همایش انتخاب می‌شوند. از این رو ثبت نام اولیه به منزله حضور قطعی در همایش نیست.
                </p>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="d-flex flex-column">
                <div class="">
                    <div class="rounded-pill border border-gray py-2 px-4 d-flex justify-content-center align-items-center w-fit ms-auto d-none d-lg-block">
                        <img src="/assets/img/add-gray.svg" alt="add icon" class="w-30 opacity-75">
                        <span class="text-gray">در حال ثبت نام</span>
                    </div>
                </div>
                <div class="d-flex position-relative inovent-time-items flex-column mt-4">
                    <span class="fs-5">شرایط حضور در همایش براساس:</span>
                    <span class="text-gray fs-7 mt-3">سوابق در بنیاد ملی نخبگان یا سوابق شاخص در پژوهش و افتخارات</span>
                </div>
                <div class="d-flex position-relative inovent-time-items flex-column mt-3">
                    <span class="fs-5 mb-3">زمان بندی</span>
                    <div class="d-flex d-lg-block">
                        <div class="d-flex me-3 me-lg-0">
                            <img src="/assets/img/add-gray.svg" class="w-30 me-1" alt="add icon">
                            <div>
                                <span class="d-block text-gray fs-7 ">زمان شروع ثبت نام</span>
                                <span class="text-gray fs-7 mt-1">1402/06/11</span>
                            </div>
                        </div>
                        <div class="d-flex mt-lg-3">
                            <img src="/assets/img/end-gray.svg" class="w-30 me-1" alt="add icon">
                            <div>
                                <span class="d-block text-gray fs-7 ">زمان پایان ثبت نام</span>
                                <span class="text-gray fs-7 mt-1">1402/06/18</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-con col-11 mx-auto mt-3 mb-5">
        @if($u_inovent == null)
        <div class="d-flex justify-content-between">
            <a href="https://app.inovaa.ir/login" class="me-2 btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/meet-sign.svg" alt="meet sign">
                <span>حضور در همایش</span>
            </a>
            <a href="https://app.inovaa.ir/login" class="d-none btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/speak-sign.svg" alt="meet sign">
                <span>سخنرانی در همایش</span>
            </a>
        </div>
        @elseif($u_inovent['status'] != 100)
        <div class="d-flex justify-content-between">
            <a href="https://app.inovaa.ir/resume" class="me-2 btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/meet-sign.svg" alt="meet sign">
                <span>حضور در همایش</span>
            </a>
            <a href="https://app.inovaa.ir/resume" class="d-none btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/speak-sign.svg" alt="meet sign">
                <span>سخنرانی در همایش</span>
            </a>
        </div>
        @elseif($u_inovent['meet'] == null)
        <div class="d-flex justify-content-between">
            <a href="https://app.inovaa.ir/resume?meet=true" class="me-2 btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/meet-sign.svg" alt="meet sign">
                <span>حضور در همایش</span>
            </a>
            <a href="https://app.inovaa.ir/resume?meet=true" class="d-none btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/speak-sign.svg" alt="meet sign">
                <span>سخنرانی در همایش</span>
            </a>
        </div>
        @elseif($u_inovent['file'] == null)
        <div class="d-flex justify-content-between">
            <a href="https://app.inovaa.ir/resume?meet=true" class="me-2 px-3 py-2 btn border border-gray text-gray rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/meet-sign.svg" alt="meet sign">
                <span>ویرایش اطلاعات ثبت نام</span>
            </a>
            <a href="https://app.inovaa.ir/resume?speak=true" class="d-none btn btn-blue rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/speak-sign.svg" alt="meet sign">
                <span>سخنرانی در همایش</span>
            </a>
        </div>
        @else
        <div class="d-flex justify-content-between">
            <a href="https://app.inovaa.ir/resume?meet=true" class="me-2 px-3 py-2 btn border border-gray text-gray rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/meet-sign.svg" alt="meet sign">
                <span>ویرایش اطلاعات ثبت نام </span>
            </a>
            <a href="https://app.inovaa.ir/resume?speak=true" class="d-none px-3 py-2 btn border border-gray text-gray rounded-pill text-decoration-none" id="meetSign">
                <img class="w-30 me-1" src="/assets/img/speak-sign.svg" alt="meet sign">
                <span> ویرایش اطلاعات سخنرانی</span>
            </a>
        </div>
        @endif

    </div>
</main>
@endsection