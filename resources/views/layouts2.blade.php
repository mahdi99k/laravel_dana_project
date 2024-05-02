<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="اینوا به منظور هدفمند کردن فعالیت‌های تحقیقاتی و برطرف کردن آسیب‌های نظام علمی کشور ایجاد شده است." />
    <meta itemprop="name" content="اینوا" />
    <meta itemprop="author" content="اینوا" />
    <meta name="keywords" content="اینوا , چالش و رویداد , نخبگان , سیزدهمین همایش ملی نخبگان , اینوونت , اینولرن , آموزش , اینوروم , انجمن">
    <meta itemprop="url" content="https://inova.ir" />

    <!--TWITTER-->
    <meta name="twitter:url" content="https://inova.ir" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="اینوا به منظور هدفمند کردن فعالیت‌های تحقیقاتی و برطرف کردن آسیب‌های نظام علمی کشور ایجاد شده است." />
    <meta name="twitter:title" content="اینوا" />
    <meta property="twitter:image" content="https://inova.ir/assets/img/logo-twitter.webp">
    <meta name="twitter:domain" content="inova.ir">
    <meta name="twitter:site" content="@inova">

    <!--OPEN GRAPH / FACEBOOK-->
    <meta property="og:url" content="https://inova.ir" />
    <meta property="og:description" content="اینوا به منظور هدفمند کردن فعالیت‌های تحقیقاتی و برطرف کردن آسیب‌های نظام علمی کشور ایجاد شده است." />
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://inova.ir/assets/img/logo-facebook.webp">
    <meta property="og:title" content="اینوا" />
    <meta property="og:site_name" content="اینوا" />
    <meta property="og:locale" content="fa_IR">
    <meta name="generator" content="inova.ir">
    <meta name="HandheldFriendly" content="true">


    <meta name="robots" content="index">
    <meta name="apple-mobile-web-app-status-bar" content="#000">
    <meta name="theme-color" content="#00fff0">

    <!-- Title -->
    @hasSection('title')
    @yield('title')
    @else
    <title>اینوا | inova</title>
    @endif


    @php
    $include_sweetalert = false;
    @endphp
    @hasSection('includes')
    yield('includes')
    @endif

    <link rel="icon" href="/assets/img/favicon.png" type="image/png">
    @if($include_sweetalert)
    <script src="/assets/js/lib/sweetalert.min.js"></script>
    @endif
    <link rel="stylesheet" href="/assets/css/vendors/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* CSS Document */

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: bold;
            src: url("/fonts/iransans/eot/IRANSansWeb(FaNum)_Bold.eot");
            src: url("/fonts/iransans/eot/IRANSansWeb(FaNum)_Bold.eot?#iefix") format("embedded-opentype"),
                /* IE6-8 */
                url("/fonts/iransans/woff2/IRANSansWeb(FaNum)_Bold.woff2") format("woff2"),
                /* FF39+,Chrome36+, Opera24+*/
                url("/fonts/iransans/woff/IRANSansWeb(FaNum)_Bold.woff") format("woff"),
                /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
                url("/fonts/iransans/ttf/IRANSansWeb(FaNum)_Bold.ttf") format("truetype");
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: normal;
            src: url("/fonts/iransans/eot/IRANSansWeb(FaNum).eot");
            src: url("/fonts/iransans/eot/IRANSansWeb(FaNum).eot?#iefix") format("embedded-opentype"),
                /* IE6-8 */
                url("/fonts/iransans/woff2/IRANSansWeb(FaNum).woff2") format("woff2"),
                /* FF39+,Chrome36+, Opera24+*/
                url("/fonts/iransans/woff/IRANSansWeb(FaNum).woff") format("woff"),
                /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
                url("/fonts/iransans/ttf/IRANSansWeb(FaNum).ttf") format("truetype");
        }

        * {
            font-family: IRANSans !important;
        }

        .bg-dark {
            background-color: #262626 !important;
        }

        main,
        body {
            background: unset;
            background-color: #202020;

        }

        nav {
            /* height: 100px; */
        }
        nav img{
            max-height: 60px;
            aspect-ratio: 2 / 1;
        }
        .nav-link {
            font-size: 17px;
            margin: 0 2px;
            color: #fff;
        }

        .nav-link.active {
            /* box-shadow: -1px -1px 4px 0px #00fff0, 0px 4px 4px 0px #00000040; */
            border: unset;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::before {
            content: "";
            height: 2px;
            width: 90%;
            border-radius: 100px;
            background: #00fff0;
            box-shadow: -1px -1px 4px 0px #00fff0, 0px 4px 4px 0px #00000040;
            opacity: 0;
            position: absolute;
            top: 0;
            right: 50%;
            transform: translateX(50%);
            transition: all 0.3s ease-in;
        }

        @media only screen and (min-width: 992px) {
            .nav-link.active::before {
                opacity: 1;
            }

            .nav-link:hover::before {
                opacity: 1;
            }
        }




        footer ul {
            padding: 0;
        }

        /*inovent-index*/
        header.inovent-header {
            width: 100%;
            height: 550px;
            background-size: cover;
            background-image: url('/assets/img/inovent_header.webp');
        }

        .inovent-header .filter-box {
            /*background-color:rgba(38, 38, 38 , 0.3);*/
            backdrop-filter: blur(5px);
        }

        .inovent-header .filter-box img {
            border-left: 1px solid #fff;
        }

        .search-inovent-box {
            background-color: rgba(38, 38, 38, 0.3);
        }

        .btn-blue {
            background-color: #0667EB;
        }

        .inovent-box {
            background-color: #262626;
        }

        .r-4-3 {
            aspect-ratio: 4 / 3;
        }

        .fs-7-5 {
            font-size: 12px;
        }

        .inovent-new {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .select-items div,
        .select-selected {
            color: white;
            outline: none;
            border-radius: 5px;
            background-color: rgb(217, 217, 217, 0.2);
        }

        .select-items div:hover,
        .same-as-selected {
            background-color: rgb(39, 39, 39);
        }

        .select-items {
            background-color: rgb(39, 39, 39);
        }

        .select-selected:after {
            position: absolute;
            content: "";
            background-image: url('/assets/img/bottom-icon.svg');
            top: 40%;
            left: 10px;
            width: 30px;
            height: 30px;
            background-repeat: no-repeat;
            border: none;
            /*border: 13px solid transparent;*/
            /*border-color: rgb(var(--bs-success-rgb)) transparent transparent transparent;*/
        }

        .modal-content {
            background-color: #262626;
        }

        @media only screen and (min-width:574px) {
            .inovent-header .filter-box {
                background-color: rgba(38, 38, 38, 0.3);
            }

            .search-inovent-box {
                background-color: unset !important;
            }
        }

        .footer-logo {
            width: 180px;
            max-width: 45%;
            aspect-ratio: 2 / 1;
        }
    </style>
    @yield('customStyle')

</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="me-md-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-between">
                @if (isset($_COOKIE['inovaa_id']))
                ‌<a aria-label="inova-page" href="https://app.inovaa.ir" class="col-md-3 w-100"><img src="/assets/img/user-icon.png" alt="پروفایل" class="img-fluid"></a>
                @else
                ‌<a aria-label="inova-page" href="https://app.inovaa.ir" class="text-decoration-none text-white btn btn-outline-secondary rounded-pill border border-secondary border-3 py-1 px-3">ورود
                    / ثبت نام</a>
                @endif


                <!--                <input type="checkbox" id="darkmode-toggle" />-->
                <!--<label class="toggle" for="darkmode-toggle">-->
                <!--<svg version="1.1" class="sun" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 496 496" style="enable-background:new 0 0 496 496;" xml:space="preserve">-->

                <!--<rect x="152.994" y="58.921" transform="matrix(0.3827 0.9239 -0.9239 0.3827 168.6176 -118.5145)" width="40.001" height="16" />-->
                <!--<rect x="46.9" y="164.979" transform="matrix(0.9239 0.3827 -0.3827 0.9239 71.29 -12.4346)" width="40.001" height="16" />-->
                <!--<rect x="46.947" y="315.048" transform="matrix(0.9239 -0.3827 0.3827 0.9239 -118.531 50.2116)" width="40.001" height="16" />-->

                <!--<rect x="164.966" y="409.112" transform="matrix(-0.9238 -0.3828 0.3828 -0.9238 168.4872 891.7491)" width="16" height="39.999" />-->

                <!--<rect x="303.031" y="421.036" transform="matrix(-0.3827 -0.9239 0.9239 -0.3827 50.2758 891.6655)" width="40.001" height="16" />-->

                <!--<rect x="409.088" y="315.018" transform="matrix(-0.9239 -0.3827 0.3827 -0.9239 701.898 785.6559)" width="40.001" height="16" />-->

                <!--<rect x="409.054" y="165.011" transform="matrix(-0.9239 0.3827 -0.3827 -0.9239 891.6585 168.6574)" width="40.001" height="16" />-->
                <!--<rect x="315.001" y="46.895" transform="matrix(0.9238 0.3828 -0.3828 0.9238 50.212 -118.5529)" width="16" height="39.999" />-->
                <!--<path d="M248,88c-88.224,0-160,71.776-160,160s71.776,160,160,160s160-71.776,160-160S336.224,88,248,88z M248,392-->
                <!--    c-79.4,0-144-64.6-144-144s64.6-144,144-144s144,64.6,144,144S327.4,392,248,392z" />-->
                <!--<rect x="240" width="16" height="72" />-->
                <!--<rect x="62.097" y="90.096" transform="matrix(0.7071 0.7071 -0.7071 0.7071 98.0963 -40.6334)" width="71.999" height="16" />-->
                <!--<rect y="240" width="72" height="16" />-->

                <!--<rect x="90.091" y="361.915" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -113.9157 748.643)" width="16" height="71.999" />-->
                <!--<rect x="240" y="424" width="16" height="72" />-->

                <!--<rect x="361.881" y="389.915" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 397.8562 960.6281)" width="71.999" height="16" />-->
                <!--<rect x="424" y="240" width="72" height="16" />-->
                <!--<rect x="389.911" y="62.091" transform="matrix(0.7071 0.7071 -0.7071 0.7071 185.9067 -252.6357)" width="16" height="71.999" />-->
                <!--</svg>-->
                <!--<svg version="1.1" class="moon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 49.739 49.739" style="enable-background:new 0 0 49.739 49.739;" xml:space="preserve">-->
                <!--<path d="M25.068,48.889c-9.173,0-18.017-5.06-22.396-13.804C-3.373,23.008,1.164,8.467,13.003,1.979l2.061-1.129l-0.615,2.268-->
                <!--   c-1.479,5.459-0.899,11.25,1.633,16.306c2.75,5.493,7.476,9.587,13.305,11.526c5.831,1.939,12.065,1.492,17.559-1.258v0-->
                <!--   c0.25-0.125,0.492-0.258,0.734-0.391l2.061-1.13l-0.585,2.252c-1.863,6.873-6.577,12.639-12.933,15.822-->
                <!--   C32.639,48.039,28.825,48.888,25.068,48.889z M12.002,4.936c-9.413,6.428-12.756,18.837-7.54,29.253-->
                <!--   c5.678,11.34,19.522,15.945,30.864,10.268c5.154-2.582,9.136-7.012,11.181-12.357c-5.632,2.427-11.882,2.702-17.752,0.748-->
                <!--   c-6.337-2.108-11.473-6.557-14.463-12.528C11.899,15.541,11.11,10.16,12.002,4.936z" />-->
                <!--</svg>-->
                <!--</label>-->

                <!--<div class="background"></div>-->



            </div>
            <!--‌<a aria-label="inova-page" class="btn" href="#"><img src="/assets/img/search-icon.png" alt="search-icon"></a>-->
        </div><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <?php
        $pageNameAll = explode('/', request()->path());
        $pageName = end($pageNameAll);
        // echo $pageName;
        ?>

        <div class="collapse navbar-collapse position-relative" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ul-nav ms-lg-5">
                <li class="nav-item">‌<a aria-label="inova-page" class="nav-link{{ $pageName == '' ? ' active' : '' }}" href="{{ route('home') }} ">معرفی اینوا</a></li>
                <li class="nav-item">‌<a aria-label="inova-page" class="nav-link{{ $pageName == 'main' ? ' active' : '' }}" href="{{ route('home') }}">صفحه اصلی</a></li>
                <li class="nav-item dropdown">
                    ‌<a aria-label="inova-page" class="nav-link dropdown-toggle{{ $pageName == 'inojob' || $pageName == 'inoje' || $pageName == 'inothes' || $pageName == 'inovent' ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        فعالیت‌های پژوهشی
                    </a>
                    <ul class="dropdown-menu">
                        <li>‌<a aria-label="inova-page" class="dropdown-item{{ $pageName == 'inojob' ? ' active' : '' }}" href="{{ route('inojob-landing') }}">کسب‌وکار</a></li>
                        <li>‌<a aria-label="inova-page" class="dropdown-item{{ $pageName == 'inoje' ? ' active' : '' }}" href="{{ route('inoje-landing') }}">طرح ومسئله</a></li>
                        <li>‌<a aria-label="inova-page" class="dropdown-item{{ $pageName == 'inothes' ? ' active' : '' }}" href="{{ route('inothes-landing') }}">پایان‌نامه و رساله</a></li>
                        <li>‌<a aria-label="inova-page" class="dropdown-item{{ $pageName == 'inovent' ? ' active' : '' }}" href="{{ route('inovent-landing') }}">چالش و رویداد</a></li>
                    </ul>
                </li>
                <li class="nav-item">‌<a aria-label="inova-page" class="nav-link{{ $pageName == 'inolearn' ? ' active' : '' }}" href="{{ route('inolearn-landing') }}">آموزش</a></li>
                <li class="nav-item">‌<a aria-label="inova-page" class="nav-link{{ $pageName == 'inoroom' ? ' active' : '' }}" href="{{ route('community-landing') }}">انجمن</a></li>
            </ul>‌
            {{-- <a aria-label="inova-page" class="navbar-brand col-5 col-sm-3 col-md-4 position-absolute d-lg-none d-block top-50" href="#"><img src="/assets/img/logo1.webp" alt="logo pic"></a> --}}
            ‌<a aria-label="inova-page" class="navbar-brand col-2 d-lg-block d-none" href="{{ route('home') }}">
                <img src="/assets/img/logo1.webp" alt="logo pic" alt="اینوا">
            </a>
        </div>
    </div>
</nav>


@yield('mainCon')

<footer class="p-md-5 p-sm-3 p-2 bg-dark">
    <div class="row flex-lg-row flex-column align-items-center col-xl-9 gx-3 mx-auto col-lg-10">
        <div class="col-lg-4 col-md-7 col-9">
            <div class="d-flex justify-content-between align-items-center">
                <img src="/assets/img/logo-bmn.webp" alt="logo" class="footer-logo" alt="بنیاد ملی نخبگان">
                <img src="/assets/img/logo1.webp" alt="logo" class="footer-logo" alt="اینوا">
            </div>
            <p class="text-muted fs-7 my-3 text-justify last-line-center">
                اینوا به منظور هدفمند کردن فعالیت‌های تحقیقاتی و برطرف کردن آسیب‌های نظام علمی کشور ایجاد شده است.
            </p>
            <div class="d-flex justify-content-center mx-auto ms-xxl-4 me-xxl-0">

                ‌<a aria-label="inova-page" href="https://instagram.com/inovaa.ir">
                    <div class="section-social instagram" tooltip="اینستاگرام">
                        <div class="icon">
                            <img src="/assets/img/instagram.webp" alt="اینستاگرام اینوا">
                        </div>
                    </div>
                </a>
                ‌<a aria-label="inova-page" href="https://t.me/inovaa">
                    <div class="section-social telegram" tooltip="تلگرام">
                        <div class="icon">
                            <img src="/assets/img/telegram.webp" alt="تلگرام اینوا">
                        </div>
                    </div>
                </a>
                ‌<a aria-label="inova-page" href="https://ble.ir/inovaa">
                    <div class="section-social bale" tooltip="بله">
                        <div class="icon">
                            <img src="/assets/img/bale.webp" alt="بله اینوا">
                        </div>
                    </div>
                </a>

            </div>
        </div>
        <div class="col-lg-8 col-12 mt-lg-0 mt-5 text-center">
            <div class="row">
                <div class="col-lg-4 col-4">
                    <ul class="text-nowrap">
                            <li class="text-warning mb-1 text-ex-bold">اینوا</li>
                        <li>
                            <a class="text-decoration-none mb-2 d-block text-muted" href="https://app.inovaa.ir">ورود به سایت</a>
                        </li>
                        <li>
                            <a class="text-decoration-none mb-2 d-block {{ $pageName != '' ? ' text-muted' : 'text-white' }}" href="{{ route('home') }}">معرفی اینوا</a>
                        </li>
                        <li>
                            <a class="text-decoration-none mb-2 d-block {{ $pageName != 'blog' ? ' text-muted' : 'text-white' }}" href="{{ route('inolearn-landing') }}">آموزش</a>
                        </li>
                        <li>
                            <a class="text-decoration-none mb-2 d-block {{ $pageName != 'forum' ? ' text-muted' : 'text-white' }}" href="{{ route('community-landing') }}">انجمن</a>
                        </li>
                        <li>
                            <a class="text-decoration-none mb-2 d-block {{ $pageName != 'inovent' ? ' text-muted' : 'text-white' }}" href="{{ route('inovent-landing') }}">چالش و رویداد</a>
                        </li>
                        <!--<a aria-label="inova-page" class="text-decoration-none " href="{{ route('help-landing', ['help' => 'about']) }}">-->
                        <!--    <li class="text-muted mb-2">درباره اینوا</li>-->
                        <!--</a>-->
                        <li>
                            <a aria-label="inova-page" class="text-decoration-none mb-2 d-block {{ $pageName != 'support' ? ' text-muted' : 'text-white' }}" href="{{ route('support-landing') }}">
                                تماس با اینوا
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-4">
                    <ul>
                        <li class=" text-warning mb-1 text-ex-bold">
                                سوالات متداول
                        </li>
                        <li>
                            <a aria-label="inova-page" class="text-decoration-none {{ $pageName == 'help' ? '' : ' text-muted' }} mb-2" href="{{ route('help-landing') }}">
                                راهنمای عمومی
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-4">
                    <ul>
                        <li class="text-warning mb-1 text-ex-bold">
                                فعالیت‌های پژوهشی
                        </li>
                        <li>
                            <a aria-label="inova-page" class="text-decoration-none mb-2 d-block{{ $pageName != 'inoje' ? ' text-muted' : 'text-white' }}" href="{{ route('inoje-landing') }}">
                                طرح ومسئله
                            </a>
                        </li>
                        <li>
                            <a aria-label="inova-page" class="text-decoration-none mb-2 d-block{{ $pageName != 'inothes' ? ' text-muted' : 'text-white' }}" href="{{ route('inothes-landing') }}">
                                پایان‌نامه و رساله
                            </a>
                        </li>
                        <li>
                            <a aria-label="inova-page" class="text-decoration-none mb-2 d-block{{ $pageName != 'inojob' ? ' text-muted' : 'text-white' }}" href="{{ route('inojob-landing') }}">
                                کسب‌وکار
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/lib/bootstrap.bundle.min.js"></script>
<script>
    try {
        makeSlider(".slide-wrapper1");
        makeSlider(".slide-wrapper2");
    } catch {
        console.log('no table');
    }
</script>
@hasSection('customScript')
@yield('customScript')
@endif