@extends('layouts2')
@section('customStyle')
<style>
    
        header {
            background-color: #000;
            position: relative;
            z-index: 0;
            height:600px;
            
        }

        .hero-bg {
            opacity: 0.6;
            left: -200px;
            height: 100%;
            background-image: url(https://inova.ir/assets/img/inovent/nano-main.webp);
            background-size: 100% 100%;
            aspect-ratio: 2500 / 1080;
            background-repeat: no-repeat;
            position: absolute;
            z-index: -1;
        }

        .hero{
            padding-top: 150px;
        }
        
        .hero .intro-img{
            width: 200px;
        }
        
        .hero .hero-img{
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
            .coworkers-con .coworkers {
                background-size: contain !important;
            }
        }
        @media only screen and (min-width: 1200px) {
            header{
                height: 800px;
            }
            
        }

        @media only screen and (min-width: 992px) {
            .hero-bg {
                left: -260px;
            }
            
        }
         
        @media only screen and (max-width: 700px) {
            .hero-bg{
                left: -95px;
            }
           
            header{
                height:300px;
            } 
            .hero-container {
                min-height: 220px;
                max-width: 50%;
                padding-right:15px;
            }
            .hero{
                padding-top: 30px;
            }
            .hero .intro-img{
                width: 120px;
            }
            .hero h2 {
                font-size: 1rem;
            }
            .hero .btn{
                font-size: 0.7rem;
            }
            .hero .hero-img{
                width: unset;
            }
            
        }
        @media only screen and (max-width: 568px) {
            header{
                height:210px;
            } 
            .hero-bg{
                left: -70px;
            }
            .hero-container {
                min-height: 150px;
                max-width: 60%;
            }
            .hero .intro-img{
                width: 60px;
            }
            .hero h2 {
                font-size: 0.9rem;
            }
            .hero .btn{
                font-size: 0.6rem;
            }
            .hero .hero-img{
                padding: 10px 0;
            }
        }
        
        

        .btn-blue {
            background-color: #0667EB;
            border: #0667EB;
        }

        .project-card {
            /*background-image: url(/assets/img/main/card-top.png);*/
            background-size: 100% 100%;
            background-color: #3D3D3D;
        }

        .project-card:nth-child(1),
        .project-card:nth-child(3) {
            text-align: left !important;
        }

        .project-card:nth-child(2),
        .project-card:nth-child(4) {}

        /*.project-card::after {*/
        /*    content: '';*/

        /*}*/

        .activities {
            min-height: 250px;
        }

        .activity-icon {
            min-height: 120px;
            /*background-color: red;*/
        }

        .question-box {
            background-color: #3D3D3D;
            height: 120px;
        }

        .question-box img{
            width: 40px;
            height: 60px;
        }

        .pointer-icon {
            background-image: url(/assets/img/main/pointer-icon.svg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .box-hover:hover {
            background-color: #3D3D3D !important;
        }

        .box-hover:hover p {
            color: #8695a1 !important;
        }

        .flipX {
            transform: scaleX(-1);
        }

        .help-item {
            width: 250px;
        }

        .activity-icon img:not(.img-fluid){
            width: 100px;
            height: 100px;
        }

        .img-flash {
            margin: 0 -4.5px -4.5px 0;
            width:120px;
            height: 120px;
        }

        .img-flash-top {
            margin: -4.5px -4.5px 0 0;
            width: 120px;
            height: 120px;
        }

        .coworkers-con {
            background-color: #8A8A8A;
            height: 160px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            transform: translate3d(0, 0, 0);
        }

        .coworkers-con .coworkers {
            background-image: url(/assets/img/main/coworkers.webp);
            background-size: cover;
            width: 100%;
            height: 100px !important;
            position: absolute;
            top: 30px;
            left: 0;
            height: 100%;
            animation: moveSlideshow 30s linear infinite;
            /*filter: saturate(0);*/
        }

        @keyframes moveSlideshow {
            0%{
                background-position-x: -100%;
            }
            50%{
                background-position-x: 0%;
            }
            100% {
                background-position-x: 100%;
            }
        }

        [class*="slide-wrapper"] {
            overflow-y: hidden !important;
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        [class*="slide-wrapper"]::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        [class*="slide-wrapper"] img {
            pointer-events: none;
        }

        
</style>
@endsection
@section('mainCon')
<header class="dir-rtl overflow-hidden carousel" style="width: ">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="hero-bg">

        </div>
        <div class="hero px-lg-5 px-2 pb-2 pb-sm-5 h-100">
            <div class="hero-container d-flex flex-column justify-content-between">
                <!-- <img src="/assets/img/main/hero-intro.svg"  class="intro-img" alt="بسم الله الرحمن ارحیم"> -->
                <!--<h2 class="d-lg-none">سیزدهمین همایش ملی نخبگان </h2>
                <h4 class="d-none d-lg-block">سیزدهمین همایش ملی نخبگان </h2>
                <h2>«نخبگان، پیشران پیشرفت»</h2>-->
                
                <img src="/assets/img/inovent/nano-intro.png" alt="همایش نانو الکترونیک" class="hero-img"/>
    
                <!-- <p class="d-none d-lg-block">
                    سیزدهمین همایش ملی نخبگان با شعار «نخبگان، پیشران پیشرفت» در هفته چهارم مهر برگزار می‌شود. 
                </p> -->
                <!--<hr>-->
                <!--<p class="fs-6">سیزدهمین همایش ملی نخبگان با عنوان «نخبگان ، پیشران پیشرفت» در هفته دوم مهر برگزار میشود.-->
                <!--</p>-->
                <div class="d-flex">
                    <a aria-label="inova-page" href="/inovent/10"
                        class="text-decoration-none py-2 text-white btn btn-primary btn-blue rounded-pill">
                        <img src="/assets/img/main/sign.svg" alt="ثبت نام در همایش" width="25px" height="25px"/>
    
                        ثبت نام در رویداد
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
</header>
<main class="px-sm-5 pb-sm-5 pt-5 p-2 overflow-x-hidden">
    <div class="row justify-content-center mt-5">
        <div class="col-12 my-5">
            <div class="row align-items-center justify-content-between dir-rtl">
                <div class="col-xxl-6 col-12 text-center row">
                    <h3 class="text-ex-bold fs-1 col-xxl-7">ما در اینوا چه می‌کنیم؟</h3>
                    <div class="d-none d-xxl-block col-xxl-5 pointer-icon"></div>
                </div>
                <div class="col-xxl-6 col-12 mt-xxl-0 mt-3 order-1 order-xxl-2 text-justify">
			در اینوا عرصه‌های نقش آفرینی مردم در حل مسائل کشور با بکارگیری ایده‌های خلاقانه میسر شده است. اینوایی شوید تا از ارزش‌های شما برای ساخت ایران عزیز بهره مند شویم.                   
	           </div>
            </div>
        </div>
    </div>
    <div class="row activities m-no mt-5 g-5 align-items-stretch d-none d-lg-flex">
        <div class=" col-12 col-sm-6 col-xl-3 pb-2 mt-4">
            <div class="rounded-5 h-100 box-hover mb-2 px-0 h-100 project-card">
                <a aria-label="inova-page" href="{{route('inovent-landing')}}" class="activity-icon d-flex align-items-start justify-content-between">
                    <img src="/assets/img/main/icon-link-top.svg" alt="لینک چالش و رویداد"
                        class="img-flash-top">
                    <img src="/assets/img/main/icon-inovent.svg" class="p-3" alt="چالش و رویداد">
                </a>
                <div class="text-start pb-4 px-xxl-5 px-3">
                    <a aria-label="inova-page" href="{{route('inovent-landing')}}" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">چالش و رویداد</a>
                    <p class="text-white text-justify">مهم ترین چالش و رویداد‌های اینوایی در این بخش آورده شده است. برای اطلاع از نحوه ثبت نام این چالش و رویداد‌ها کلیک کنید.</p>
                </div>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-xl-3 pb-2 mt-4">
            <div
                class="rounded-5 h-100 box-hover d-flex flex-column justify-content-between mb-2 px-0 h-100 project-card">
                <div class="text-start pt-4 px-xxl-5 px-3">
                    <a aria-label="inova-page" href="{{route('inolearn-landing')}}"  class="text-decoration-none text-white fs-5 ms-2 text-nowrap">آموزش</a>
                    <p class="text-white text-justify">پیشرفته ترین دوره‌های آموزشی و مهارتی با تفکیک حوزه‌های فعالیتی در این بخش آماده شده است. برای تهیه این دوره‌ها، کلیک کنید.
                        </p>
                </div>
                <a aria-label="inova-page" href="{{route('inolearn-landing')}}" class="activity-icon d-flex align-items-end justify-content-between">
                    <img src="/assets/img/main/icon-link-bottom.svg" alt="لینک آموزش"
                        class="img-flash">
                    <img src="/assets/img/main/icon-inolearn.svg" class="p-3" alt="آموزش">
                </a>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-xl-3 pb-2 mt-4">
            <div class="rounded-5 h-100 box-hover mb-2 px-0 h-100 project-card">
                <a aria-label="inova-page" href="{{route('community-landing')}}" class="activity-icon d-flex align-items-start justify-content-between">
                    <img src="/assets/img/main/icon-link-top.svg" alt="لینک انجمن"
                        class="img-flash-top">
                    <img src="/assets/img/main/icon-inoroom.svg" class="p-3" alt="انجمن">
                </a>
                <div class="text-start pb-4 px-xxl-5 px-3">
                    <a aria-label="inova-page" href="{{route('community-landing')}}" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">انجمن</a>
                    <p class="text-white text-justify">
                        پاتوقی برای مطرح کردن مشکلات علمی و پژوهشی یکی از نیازهای اساسی برای رشد و پیشرفت علمی است، به پاتوق اینوایی‌ها بپیوندید.
                        </p>

                </div>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-xl-3 pb-2 mt-4">
            <div
                class="rounded-5 h-100 box-hover d-flex flex-column justify-content-between mb-2 px-0 h-100 project-card">

                <div class="text-start pt-4 px-xxl-5 px-3">
                    <a aria-label="inova-page" href="/main" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">فعالیت‌های پژوهشی</a>
                    <p class="text-white text-justify">
                        پروژه‌های تحقیقاتی و صنعتی مهم ترین بستر تبدیل دانش به فناوری است. اینوا تلاش دارد تا بستری برای توزیع فرصت‌های تحقیقاتی ایجاد کند.
                    </p>
                </div>

                <a aria-label="inova-page" href="/main" class="activity-icon d-flex align-items-end justify-content-between">
                    <img src="/assets/img/main/icon-link-bottom.svg" alt="لینک فعالیت‌های پژوهشی"
                        class="img-flash">
                    <img src="/assets/img/main/icon-activities.svg" class="p-3" alt="فعالیت‌های پژوهشی">
                </a>
            </div>
        </div>
    </div>
<div class="row activities m-no mt-0 flex-nowrap g-3 align-items-stretch slide-wrapper1 d-lg-none d-flex" style="cursor: grab;">
        <div class=" col-9 col-sm-5 col-xl-3 mt-5">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="text-start pt-4 px-xxl-5 px-3">
                <img src="/assets/img/main/icon-inovent.svg" class="چالش و رویداد" style="
                    direction: rtl;
                    width: 25px;
                    height: 25px;
                ">
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">چالش و رویداد</h3>
                    <p class="text-white fs-7 mb-0 text-justify">مهم ترین چالش و رویداد‌های اینوایی در این بخش آورده شده است. برای اطلاع از نحوه ثبت نام این چالش و رویداد‌ها کلیک کنید.</p>
                </div>
                <a aria-label="inova-page" href="/inovent" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" alt="چالش و رویداد" class="p-3 rounded-3">
                </a>
            </div>
        </div>
        <div class=" col-9 col-sm-5 col-xl-3 mt-5">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="text-start pt-4 px-xxl-5 px-3">
                <img src="/assets/img/main/icon-inolearn.svg" alt="آموزش" style="
                    direction: rtl;
                    width: 25px;
                    height: 25px;
                ">
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">آموزش</h3>
                    <p class="text-white fs-7 mb-0 text-justify">پیشرفته ترین دوره‌های آموزشی و مهارتی با تفکیک حوزه‌های فعالیتی در این بخش آماده شده است. برای تهیه این دوره‌ها، کلیک کنید.
                        </p>
                </div>
                <a aria-label="inova-page" href="/inolearn" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک آموزش">
                </a>
            </div>
        </div>
        <div class=" col-9 col-sm-5 col-xl-3 mt-5">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="text-start pt-4 px-xxl-5 px-3">
                <img src="/assets/img/main/icon-inoroom.svg" alt="انجمن" style="
                    direction: rtl;
                    width: 25px;
                    height: 25px;
                ">
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">انجمن</h3>
                    <p class="text-white fs-7 mb-0 text-justify">پاتوقی برای مطرح کردن مشکلات علمی و پژوهشی یکی از نیازهای اساسی برای رشد و پیشرفت علمی است، به پاتوق اینوایی‌ها بپیوندید.</p>
                </div>
                <a aria-label="inova-page" href="/inoroom" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک انجمن">
                </a>
            </div>
        </div>
        <div class=" col-9 col-sm-5 col-xl-3 mt-5">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="text-start pt-4 px-xxl-5 px-3">
                <img src="/assets/img/main/icon-inolearn.svg" alt="فعالیت‌های پژوهشی" style="
                    direction: rtl;
                    width: 25px;
                    height: 25px;
                ">
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">فعالیت‌های پژوهشی</h3>
                    <p class="text-white fs-7 mb-0 text-justify">پروژه‌های تحقیقاتی و صنعتی مهم ترین بستر تبدیل دانش به فناوری است. اینوا تلاش دارد تا بستری برای توزیع فرصت‌های تحقیقاتی ایجاد کند.</p>
                </div>
                <a aria-label="inova-page" href="/main" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک فعالیت‌های پژوهشی">
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 my-5">
            <div class="row align-items-center justify-content-between dir-rtl">
                <div class="col-xxl-6 col-12 text-center row">
                    <h3 class="text-ex-bold fs-1 col-xxl-7">شبکه سازی نخبگان</h3>
                    <div class="d-none d-xxl-block col-xxl-5 pointer-icon"></div>
                </div>
                <div class="col-xxl-6 col-12 mt-xxl-0 mt-3 order-1 order-xxl-2 text-justify">
                    ما با ایجاد شبکه ای از نخبگان می‌خواهیم در برقراری ارتباطات شما با طیف وسیعی از متخصصینی که می‌توانند
                    برای رسیدن به اهدافتان شما را یاری دهند سهیم باشیم. پیداست وقتی باهم باشیم کارهای بزرگتری انجام
                    می‌دهیم، برقراری ارتباط در اینوا به معنی ایجاد یک ارتباط و تعهد بلندمدت است.



                </div>
            </div>
        </div>
    </div>
    <div class="row activities m-no mt-5 flex-nowrap g-5 align-items-stretch slide-wrapper2 d-none d-lg-flex">
        <div class="col-9 col-xl pb-2">
            <div class="rounded-5 h-100 box-hover d-flex flex-column justify-content-between mb-2 h-100 project-card">
                <div class="activity-icon rounded-5 p-3">
                    <img class="img-fluid rounded-5" src="/assets/img/main/projects/3.webp" alt="پایان‌نامه و رساله">
                </div>

                <div
                    class="activity-icon mt-2 d-flex h-100 align-items-end justify-content-between position-relative">
                    <a aria-label="inova-page" href="{{route('inothes-landing')}}" ><img src="/assets/img/main/icon-link-bottom.svg" alt="لینک پایان‌نامه و رساله" class="img-flash"></a>
                    <div class="d-flex flex-column align-items-start p-2">
                        <a aria-label="inova-page" href="{{route('inothes-landing')}}" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">پایان‌نامه و رساله</a>
                        <p class="text-gray text-justify">اینوا از پایان نامه‌های دانشگاهی در حوزه‌های پیشرفته که منجر
                            به تولید ارزش می شود، حمایت می کند.</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-9 col-xl pb-2">
            <div class="rounded-5 h-100 box-hover d-flex flex-column justify-content-between mb-2 h-100 project-card">
                <div class="activity-icon rounded-5 p-3">
                    <img class="img-fluid rounded-5" src="/assets/img/main/projects/2.webp" alt="طرح و مسئله">
                </div>

                <div
                    class="activity-icon mt-2 d-flex h-100 align-items-end justify-content-between position-relative">
                    <a aria-label="inova-page" href="{{route('inoje-index')}}"><img src="/assets/img/main/icon-link-bottom.svg" alt="لینک انینوژه" class="img-flash"></a>
                    <div class="d-flex flex-column align-items-start p-2">
                        <a aria-label="inova-page" href="{{route('inoje-index')}}" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">طرح و مسئله</a>
                        <p class="text-gray text-justify">بستری برای تعامل کارفرمایان و پژوهشگران و دانشجویان در قالب
                            پروژه‌های حل مسئله می باشد.</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-9 col-xl pb-2">
            <div class="rounded-5 h-100 box-hover d-flex flex-column justify-content-between mb-2 h-100 project-card">
                <div class="activity-icon rounded-5 p-3">
                    <img class="img-fluid rounded-5" src="/assets/img/main/projects/1.webp" alt="کسب‌وکار">
                </div>

                <div
                    class="activity-icon mt-2 d-flex h-100 align-items-end justify-content-between position-relative">
                    <a aria-label="inova-page"  href="{{route('inojob-landing')}}"><img src="/assets/img/main/icon-link-bottom.svg" alt="لینک کسب‌وکار" class="img-flash"></a>
                    <div class="d-flex flex-column align-items-start p-2">
                        <a aria-label="inova-page" href="{{route('inojob-landing')}}" class="text-decoration-none text-white fs-5 ms-2 text-nowrap">کسب‌وکار</a>
                        <p class="text-gray text-justify">اینوایی‌ها متناسب با کار آمدی و ارزش آفرینی شان، به موقعیت‌های شغلی معرفی می شوند.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="row activities m-no mt-5 flex-nowrap g-1 g-lg-5 d-lg-none align-items-stretch slide-wrapper3">
        <div class="col-9 col-lg pb-2">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="activity-icon rounded-3 overflow-hidden p-2">
                    <img class="img-fluid rounded-3" src="/assets/img/main/projects/3.webp" alt="پایان‌نامه و رساله">
                </div><div class="text-start  px-xxl-5 px-3">
                
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">پایان‌نامه و رساله</h3>
                    <p class="text-white fs-7 mb-0 text-justify">اینوا از پایان نامه‌های دانشگاهی در حوزه‌های پیشرفته که منجر به تولید ارزش می شود، حمایت می کند.</p>
                </div>
                <a aria-label="inova-page" href="{{ route('inothes-landing') }}" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک پایان‌نامه و رساله">
                </a>
            </div>
        </div>
        <div class="col-9 col-lg pb-2">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="activity-icon rounded-3 overflow-hidden p-2">
                    <img class="img-fluid rounded-3" src="/assets/img/main/projects/2.webp" alt="طرح و مسئله">
                </div><div class="text-start  px-xxl-5 px-3">
                
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">طرح و مسئله</h3>
                    <p class="text-white fs-7 mb-0 text-justify">بستری برای تعامل کارفرمایان و پژوهشگران و دانشجویان در قالب پروژه‌های حل مسئله می باشد.</p>
                </div>
                <a aria-label="inova-page" href="{{ route('inoje-index') }}" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک طرح و مسئله">
                </a>
            </div>
        </div>
        <div class="col-9 col-lg pb-2">
            <div class="rounded-3 box-hover d-flex flex-column justify-content-between mb-2 px-0 project-card h-100">
                <div class="activity-icon rounded-3 overflow-hidden p-2">
                    <img class="img-fluid rounded-3" src="/assets/img/main/projects/1.webp" alt="کسب‌وکار">
                </div><div class="text-start  px-xxl-5 px-3">
                
                    <h3 class="fs-6 ms-0 text-nowrap d-inline">کسب‌وکار</h3>
                    <p class="text-white fs-7 mb-0 text-justify">اینوایی‌ها متناسب با کار آمدی و ارزش آفرینی شان، به موقعیت‌های شغلی معرفی می شوند.</p>
                </div>
                <a aria-label="inova-page" href="{{ route('inojob-landing') }}" class="d-flex justify-content-end">
                    
                    <img src="/assets/img/main/icon-link.svg" class="p-3 rounded-3" alt="لینک کسب‌وکار">
                </a>
            </div>
        </div>
    </div>
    
    
    <div class="row justify-content-center mt-5">
        <div class="col-12 my-5">
            <div class="row align-items-center justify-content-between dir-rtl">
                <div class="col-xxl-6 col-12 text-center row">
                    <h3 class="text-ex-bold fs-2 col-xxl-7">پاسخ سوالات پرتکرار شما</h3>
                    <div class="d-none d-xxl-block col-xxl-5 pointer-icon"></div>
                </div>
                <div class="col-xxl-6 col-12 mt-xxl-0 mt-3 order-1 order-xxl-2 text-justify">با مطالعه سؤالات متداول و
                    راهنمای اینوا، به پاسخ بسیاری از سوالات خود را راجع به پلتفرم اینوا خواهید رسید.
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center g-4">
        <a aria-label="inova-page" href="/help/supervisor"
            class="d-flex align-items-center justify-content-center help-item text-decoration-none mx-2 mb-3">
            <div
                class="d-flex align-items-center justify-content-center w-100 px-2 text-center question-box rounded-4">
                <img src="assets/img/main/barg-icon.svg" alt="tik" class="flipX">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span class="text-gray d-lg-block">راهنمای</span>
                    <span class="text-success text-ex-bold fs-4 ms-lg-0 p-0 pe-1 ">استاد راهنما</span>
                </div>
                <img src="assets/img/main/barg-icon.svg" alt="tik">
            </div>
        </a>
        <a aria-label="inova-page" href="/help/researcher"
            class="d-flex align-items-center justify-content-center help-item text-decoration-none mx-2 mb-3">
            <div
                class="d-flex align-items-center justify-content-center w-100 px-2 text-center question-box rounded-4">
                <img src="assets/img/main/barg-icon.svg" alt="tik" class="flipX">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span class="text-gray d-lg-block">راهنمای</span>
                    <span class="text-success text-ex-bold fs-4 ms-lg-0 p-0 pe-1 ">پژوهشگر</span>
                </div>
                <img src="assets/img/main/barg-icon.svg" alt="tik">
            </div>
        </a>
        <a aria-label="inova-page" href="/help/reviewer"
            class="d-flex align-items-center justify-content-center help-item text-decoration-none mx-2 mb-3">
            <div
                class="d-flex align-items-center justify-content-center w-100 px-2 text-center question-box rounded-4">
                <img src="assets/img/main/barg-icon.svg" alt="tik" class="flipX">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span class="text-gray d-lg-block">راهنمای</span>
                    <span class="text-success text-ex-bold fs-4 ms-lg-0 p-0 pe-1 "> &nbsp داور &nbsp </span>
                </div>
                <img src="assets/img/main/barg-icon.svg" alt="tik">
            </div>
        </a>
        <a aria-label="inova-page" href="/help/employer"
            class="d-flex align-items-center justify-content-center help-item text-decoration-none mx-2 mb-3">
            <div
                class="d-flex align-items-center justify-content-center w-100 px-2 text-center question-box rounded-4">
                <img src="assets/img/main/barg-icon.svg" alt="tik" class="flipX">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span class="text-gray d-lg-block">راهنمای</span>
                    <span class="text-success text-ex-bold fs-4 ms-lg-0 p-0 pe-1 ">کارفرما</span>
                </div>
                <img src="assets/img/main/barg-icon.svg" alt="tik">
            </div>
        </a>
        <a aria-label="inova-page" href="/help/general"
            class="d-flex align-items-center justify-content-center help-item text-decoration-none mx-2 mb-3">
            <div
                class="d-flex align-items-center justify-content-center w-100 px-2 text-center question-box rounded-4">
                <img src="assets/img/main/barg-icon.svg" alt="tik" class="flipX">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span class="text-gray d-lg-block">راهنمای</span>
                    <span class="text-success text-ex-bold fs-4 ms-lg-0 p-0 pe-1 ">عمومی</span>
                </div>
                <img src="assets/img/main/barg-icon.svg" alt="tik">
            </div>
        </a>
    </div>
</main>
<h2 class="text-center mb-3">همکاران اینوا</h2>
<div class="coworkers-con mb-5">

    <div class="coworkers"></div>
</div>

@endsection
@section('customScript')
<script>
    try {
        makeSlider(".slide-wrapper1");
        makeSlider(".slide-wrapper2");
        makeSlider(".slide-wrapper3");
    } catch {
        console.log('no table');
    }
</script>
@endsection