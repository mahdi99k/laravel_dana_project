<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script>
        function addClass(A) {
            document.documentElement.classList.add(A);
        }
        var avif = new Image();

        function check_webp_feature(a) {
            var e = new Image();
            (e.onload = function() {
                var A = 0 < e.width && 0 < e.height;
                a(A);
            }),
            (e.onerror = function() {
                a(!1);
            }),
            (e.src =
                "data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==");
        }
        (avif.src =
            "data:image/avif;base64,AAAAIGZ0eXBhdmlmAAAAAGF2aWZtaWYxbWlhZk1BMUIAAADybWV0YQAAAAAAAAAoaGRscgAAAAAAAAAAcGljdAAAAAAAAAAAAAAAAGxpYmF2aWYAAAAADnBpdG0AAAAAAAEAAAAeaWxvYwAAAABEAAABAAEAAAABAAABGgAAAB0AAAAoaWluZgAAAAAAAQAAABppbmZlAgAAAAABAABhdjAxQ29sb3IAAAAAamlwcnAAAABLaXBjbwAAABRpc3BlAAAAAAAAAAIAAAACAAAAEHBpeGkAAAAAAwgICAAAAAxhdjFDgQ0MAAAAABNjb2xybmNseAACAAIAAYAAAAAXaXBtYQAAAAAAAAABAAEEAQKDBAAAACVtZGF0EgAKCBgANogQEAwgMg8f8D///8WfhwB8+ErK42A="
        ),
        (avif.onload = function() {
            addClass("avif");
        }),
        (avif.onerror = function() {
            check_webp_feature(function(A) {
                return addClass(A ? "webp" : "fallback");
            });
        });
    </script>
    <link rel="stylesheet" href="/assets-new/css/vendor/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/assets-new/css/vendor/flaticon.min.css" />
    <link rel="stylesheet" href="/assets-new/css/style.css" />
    <link rel="stylesheet" href="/assets-new/css/responsive.css" />
</head>

<body>
    <nav>
        <div class="con d-flex align-items-center justify-content-between align-items-center">
            <div class="text-white" id="menu-toggle">
                <i class="fi fi-rr-bars-staggered"></i>
            </div>
            <img src="/assets-new/img/inova.png" alt="inova" class="ms-0 ms-sm-5" />
            <div class="text-white ms-auto me-4 d-none d-sm-block">
                <i class="fi fi-rr-search"></i>
            </div>
            <div class="text-white me-4 d-none d-sm-block">
                <i class="fi fi-rr-moon-stars"></i>
            </div>
            <a href="#"><i class="fi fi-rr-user"></i></a>
        </div>
    </nav>
    <header class="position-relative user-select-none">
        <section id="heroBg">
            <div data-slide="1"
                class="hero-bg fadeinRight position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
            <div data-slide="2" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0">
            </div>
            <div data-slide="3" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0">
            </div>
            <div data-slide="4" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0">
            </div>
        </section>

        <section id="hero">
            <div class="con position-relative d-lg-flex align-items-center justify-content-between h-lg-75 h-50">
                <div class="d-flex justify-content-lg-start justify-content-center position-relative hero-intro-con">
                    <div
                        class="hero-line fadeinDownDelay h-100 position-absolute start-0 d-flex flex-column justify-content-center">
                        <span class="slider-counter">01</span>
                        <div class="hero-line-all h-100 w-100 position-relative bg-white-50 rounded-pill my-2">
                            <div class="position-absolute bg-white rounded-pill w-100 hero-line-fill"
                                style="--slide: 1;--slide-count: 4;"></div>
                        </div>
                        <span>04</span>
                    </div>
                    <div class="hero-intro fadeinRightDelay px-2 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h1 class="text-bold">اینوجاب /</h1>
                            <div class="position-relative title-con d-flex justify-content-lg-start justify-content-center"
                                id="titles">
                                <div class="top-0 titleAll opacity-100">
                                    <h3 class="title title-sm">جذب در دستگاه‌ های اجرایی</h3>
                                    <a href="#" class="mt-4">برای مشاهده تمام موقعیت های شغلی کلیک کنید</a>
                                </div>
                                <div class="position-absolute top-0 titleAll">
                                    <h3 class="title title-sm">جذب در شرکت های خصوصی</h3>
                                    <a href="#" class="mt-4">برای مشاهده تمام موقعیت های شغلی کلیک کنید</a>
                                </div>
                                <div class="position-absolute top-0 titleAll">
                                    <h3 class="title">فریلنســــری</h3>
                                    <a href="#" class="mt-4">برای مشاهده تمام موقعیت های شغلی کلیک کنید</a>
                                </div>
                                <div class="position-absolute top-0 titleAll">
                                    <h3 class="title title-sm">کــــار آفرینی</h3>
                                    <a href="#" class="mt-4">برای مشاهده تمام موقعیت های شغلی کلیک کنید</a>
                                </div>
                            </div>
                        </div>

                        <!-- <a href="#">
              <span class="d-none d-lg-inline">مشاهده همه</span>
              <i class="fi fi-rr-angle-circle-down ms-2"></i>
            </a> -->

                    </div>
                </div>
                <div class="hero-downside fadeinUpDelay d-none d-lg-flex con justify-content-end align-items-center">
                    <div class="hero-counter-con d-none">
                        <div class="hero-counter">
                            <span class="slider-counter">01</span>
                            <span class="opacity-50">/04</span>
                        </div>
                        <div class="hero-links">
                            <ul class="list-inline opacity-50">
                                <li class="list-inline-item">لینک یک</li>
                                <li class="list-inline-item">لینک دو</li>
                                <li class="list-inline-item">لینک سه</li>
                            </ul>
                        </div>
                    </div>
                    <div class="hero-slider-con">
                        <div class="hero-slider-top d-none d-flex justify-content-between">
                            <div class="hero-slider-toggle dir-ltr cursor-default">
                                <span class="rounded-circle cursor-pointer bg-white-50 bg-white"></span>
                                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                            </div>
                            <p class="text-underline">سایر دسته‌بندی‌ها</p>
                        </div>
                        <div class="hero-slider d-flex flex-column justify-content-between align-items-center dir-ltr">
                            <div class="hero-slider-img cursor-pointer inojob" style="--slide: -1"></div>
                            <div class="hero-slider-img cursor-pointer inojob" style="--slide: 0"></div>
                            <div class="hero-slider-img cursor-pointer inojob" style="--slide: 1"></div>
                        </div>
                    </div>
                </div>

            </div>
            <form action="" class="container p-0">
                <div class="row justify-content-between align-items-stretch g-2">
                    <div class="col-lg-6">
                        <div class="position-relative h--60">
                            <input type="text" name="" id="test" class="has-label h-100" required>
                            <label for="" class="label-before">استان محل کار</label>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="custom-select s1 h-100 m-0">
                            <div class="select-btn">
                                <span>استان محل کار</span>
                                <i class="uil uil-angle-down"></i>
                            </div>
                            <div class="content">
                                <div class="search">
                                    <i class="uil uil-search"></i>
                                    <input spellcheck="false" type="text" placeholder="جستجو" />
                                </div>
                                <ul class="options"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="label-white d-flex place-center h--60">
                            <span>جستجو کنید</span>
                            <i class="fi fi-rr-search"></i>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </header>
    <main>

        <div class="container">

            <div class="row justify-content-center align-items-center position-relative mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="">
                        <div>
                            <div class="title mb-1 fs-2">
                                برترین سازمان ها
                            </div>
                            <span class="text-secondry">
                                پیشنهاد شده براساس بیشترین استخدامی‌ها
                            </span>
                        </div>
                    </div>
                    <div class="">
                        <div class="label-white space-nowrap">
                            مشاهده همه
                        </div>
                        <div class="d-flex scroll-buttons justify-content-between mt-3">
                            <div class="bg-white-10 rounded-3 best-next">
                                <i class="fi fi-rr-angle-small-right fs-3 py-3 px-2 cursor-pointer"></i>
                            </div>
                            <div class="bg-white-10 rounded-3 best-prev">
                                <i class="fi fi-rr-angle-small-left fs-3 py-3 px-2 cursor-pointer"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden col-12">
                    <div class="row flex-nowrap justify-content-between best-slider no-scrollbar scroll-snap-x">
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                            <div class="box box-card">
                                <div class="inner">
                                    <div class="">
                                        <img src="/assets-new/img/activities/inoje/avif/3.avif" class="w-100 ratio4-3"
                                            alt="">
                                    </div>
                                    <div class="inner-content">
                                        <h3>سازمان سنجش</h3>
                                        <div class="d-flex">
                                            <div class="label">20 فرصت شغلی</div>
                                            <div class="label">در 2 ماه اخیر</div>
                                        </div>
                                        <p class="line-clamp-5 opacity-75 mt-2">
                                            سازمان سنجش و آموزش کشور به نشانی sanjesh.org، سامانه ای است که مراحل پذیرش
                                            داوط
                                            لبان
                                            را
                                            به منظور ورود به آموزش عالی و ادامه تحصیل فراهم می کند. در این سایت علاوه بر
                                            پذیرش
                                            دانشجو، جذب متقاضیان استخدام در مراکز دولتی
                                        </p>
                                        <a href="#">
                                            <span>مشاهده همه فرصت های شغلی</span>
                                            <i class="fi fi-rr-angle-small-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                            <div class="box box-card">
                                <div class="inner">
                                    <div class="bg-danger">
                                        <img src="/assets-new/img/activities/inoje/avif/3.avif" class="w-100 ratio4-3"
                                            alt="">
                                    </div>
                                    <div class="inner-content">
                                        <h3>سازمان سنجش</h3>
                                        <div class="d-flex">
                                            <div class="label">20 فرصت شغلی</div>
                                            <div class="label">در 2 ماه اخیر</div>
                                        </div>
                                        <p class="line-clamp-5 opacity-75 mt-2">
                                            سازمان سنجش و آموزش کشور به نشانی sanjesh.org، سامانه ای است که مراحل پذیرش
                                            داوط
                                            لبان
                                            را
                                            به منظور ورود به آموزش عالی و ادامه تحصیل فراهم می کند. در این سایت علاوه بر
                                            پذیرش
                                            دانشجو، جذب متقاضیان استخدام در مراکز دولتی
                                        </p>
                                        <a href="#">
                                            <span>مشاهده همه فرصت های شغلی</span>
                                            <i class="fi fi-rr-angle-small-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                            <div class="box box-card">
                                <div class="inner">
                                    <div class="bg-danger">
                                        <img src="/assets-new/img/activities/inoje/avif/3.avif" class="w-100 ratio4-3"
                                            alt="">
                                    </div>
                                    <div class="inner-content">
                                        <h3>سازمان سنجش</h3>
                                        <div class="d-flex">
                                            <div class="label">20 فرصت شغلی</div>
                                            <div class="label">در 2 ماه اخیر</div>
                                        </div>
                                        <p class="line-clamp-5 opacity-75 mt-2">
                                            سازمان سنجش و آموزش کشور به نشانی sanjesh.org، سامانه ای است که مراحل پذیرش
                                            داوط
                                            لبان
                                            را
                                            به منظور ورود به آموزش عالی و ادامه تحصیل فراهم می کند. در این سایت علاوه بر
                                            پذیرش
                                            دانشجو، جذب متقاضیان استخدام در مراکز دولتی
                                        </p>
                                        <a href="#">
                                            <span>مشاهده همه فرصت های شغلی</span>
                                            <i class="fi fi-rr-angle-small-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                            <div class="box box-card">
                                <div class="inner">
                                    <div class="bg-danger">
                                        <img src="/assets-new/img/activities/inoje/avif/3.avif" class="w-100 ratio4-3"
                                            alt="">
                                    </div>
                                    <div class="inner-content">
                                        <h3>سازمان سنجش</h3>
                                        <div class="d-flex">
                                            <div class="label">20 فرصت شغلی</div>
                                            <div class="label">در 2 ماه اخیر</div>
                                        </div>
                                        <p class="line-clamp-5 opacity-75 mt-2">
                                            سازمان سنجش و آموزش کشور به نشانی sanjesh.org، سامانه ای است که مراحل پذیرش
                                            داوط
                                            لبان
                                            را
                                            به منظور ورود به آموزش عالی و ادامه تحصیل فراهم می کند. در این سایت علاوه بر
                                            پذیرش
                                            دانشجو، جذب متقاضیان استخدام در مراکز دولتی
                                        </p>
                                        <a href="#">
                                            <span>مشاهده همه فرصت های شغلی</span>
                                            <i class="fi fi-rr-angle-small-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                            <div class="box box-card">
                                <div class="inner">
                                    <div class="bg-danger">
                                        <img src="/assets-new/img/activities/inoje/avif/3.avif" class="w-100 ratio4-3"
                                            alt="">
                                    </div>
                                    <div class="inner-content">
                                        <h3>سازمان سنجش</h3>
                                        <div class="d-flex">
                                            <div class="label">20 فرصت شغلی</div>
                                            <div class="label">در 2 ماه اخیر</div>
                                        </div>
                                        <p class="line-clamp-5 opacity-75 mt-2">
                                            سازمان سنجش و آموزش کشور به نشانی sanjesh.org، سامانه ای است که مراحل پذیرش
                                            داوط
                                            لبان
                                            را
                                            به منظور ورود به آموزش عالی و ادامه تحصیل فراهم می کند. در این سایت علاوه بر
                                            پذیرش
                                            دانشجو، جذب متقاضیان استخدام در مراکز دولتی
                                        </p>
                                        <a href="#">
                                            <span>مشاهده همه فرصت های شغلی</span>
                                            <i class="fi fi-rr-angle-small-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between my-5">
                <div class="col-lg-5">
                    <div class="title fs-2">حوزه های فعالیت</div>
                    <p class="text-justify opacity-50 mt-3">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، لورم ایپسوم متن ساختگی با
                        تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه
                        و مجله در ستون و سطرآنچنان که لازم است،
                    </p>
                    <button class="label-white mt-3 text-white px-3 py-2">
                        مشاهده همه
                    </button>
                </div>
                <div class="col-lg-5 d-flex">
                    <div class="box counter-box">
                        <div class="inner p-3 d-felx align-items-center justify-content-center">
                            <img src="/assets-new/img/activities/inojob/svg/freelancing.svg" alt="freelancing"
                                class="bg-success">
                                <div
                                    class="d-flex border-linear flex-column align-items-center justify-content-center rounded-circle w-200p">
                                    <span class="position-absolute bottom-n-20 fs-3 bottom-0">259</span>
                                    <span class="position-absolute bottom-n-0 fs-3 top-100">دستگاه‌های دولتی</span>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row box w-100 my-5">
                <div class="inner">
                    <div class="row p-4">
                        <div class="col-12 border-bottom border-secondary pb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="col-lg-10 text-lg-start text-center">
                                    <p class="fs-5">دانلود دفترچه موقعیت های شغلی در دستگاه های اجرایی</p>
                                    <p class="opacity-50 mt-1">برای دانلود فایل پی دی اف دفترچه موقعیت های شغلی در
                                        دستگاه های اجرایی روی دکمه ی روبرو کلیک کنید</p>
                                </div>
                                <button
                                    class="btn btn-primary p-2 col-lg-2 col-8 d-flex justify-content-center flex-nowrap align-items-center m-lg-0 mx-auto">
                                    <span class="me-3 space-nowrap">دانلود کنید</span>
                                    <i class="fi fi-rr-cloud-download-alt fs-4"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="col-lg-10 text-lg-start text-center">
                                    <p class="fs-5">ثبت نام در موقعیت های شغلی دستگاه های اجرایی</p>
                                    <p class="opacity-50 mt-1">برای ثبت نام در موقعیت های شغلی دستگاه های اجرایی
                                        میتوانید با کلیک روی دکمه ی روبرو اقدام کنید</p>
                                </div>
                                <button
                                    class="btn btn-primary p-3 col-lg-2 col-8 d-flex justify-content-center flex-nowrap align-items-center m-lg-0 mx-auto">
                                    <span class="me-3 space-nowrap">ثبت نام کاربری</span>
                                    <i class="fi fi-rr-user-add fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-5">
                <div class="mt-5">
                    <div class="title fs-2">
                        سوالات متداول
                    </div>
                    <p>بیشترین سوالات پرسیده شده توسط کاربران از ما</p>
                </div>
            </div>
            <div class="row">
                <div class="row mb-5">
                    <div class="accordion mb-5 col-xl-8" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است،
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن
                                    ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                    صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است،
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن
                                    ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                    صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true"
                                    aria-controls="collapseThree">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است،
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن
                                    ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                    صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است،
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن
                                    ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                    صنعت چاپ، لازم است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="accordion" id="accordionType">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseType" aria-expanded="true" aria-controls="collapseType">
                                نوع همکاری
                            </button>
                        </h2>
                        <div id="collapseType" class="accordion-collapse collapse" data-bs-parent="#accordionType">
                            <div class="accordion-body">
                                <input type="checkbox-border" id="check1" name="radio">
                                <label for="check1">تست 1</label>
                                <input type="checkbox-border" id="check2" name="radio">
                                <label for="check2">تست 2</label>
                                <input type="checkbox-border" id="check3" name="radio">
                                <label for="check3">تست 3</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}



        </div>


    </main>
    <footer class="bg-dark pt-lg-4 pt-2 px-lg-5 px-1">
        <div class="container">
            <div class="row g-lg-5 g-2">
                <div class="col-lg-5 col-12">
                    <div>
                        <h3 class="fs-5 mb-3">اینوا</h3>
                        <p class="text-justify opacity-50">
                            اینوا به منظور هدفمند کردن فعالیت‌های تحقیقاتی و برطرف کردن آسیب‌های نظام علمی کشور ایجاد
                            شده است. در اینوا عرصه‌های نقش آفرینی مردم در حل مسائل کشور با بکارگیری ایده‌های خلاقانه
                            میسر شده است. اینوایی شوید تا از ارزش‌های شما برای ساخت ایران عزیز بهره مند شویم.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h3 class="fs-5 mb-3">
                        لینک های مفید
                    </h3>
                    <ul class="list-items-none p-0">
                        <li><a href="#" class="opacity-50 fs-14 mb-1">معرفی اینوا</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">اینولرن</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">اینوروم</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">اینوونت</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h3 class="fs-5 mb-3">
                        سوالات متداول
                    </h3>
                    <ul class="list-items-none p-0">
                        <li><a href="#" class="opacity-50 fs-14 mb-1">راهنمای عمومی</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">راهنمای استاد راهنما</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">راهنمای پژوهشگر</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 d-none d-lg-block">
                    <h3 class="fs-5 mb-3">
                        فعالیت‌های پژوهشی
                    </h3>
                    <ul class="list-items-none p-0">
                        <li><a href="#" class="opacity-50 fs-14 mb-1">طرح و مسئله</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">کسب و کار</a></li>
                        <li><a href="#" class="opacity-50 fs-14 mb-1">پایان نامه</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row rounded-4 bg-white-10 border p-lg-5 p-2 align-items-stretch">
            <div class="col-lg-5 d-flex">
                <div class="h--100">
                    <img src="/assets-new/img/logo1.webp" class="h-100 me-5" alt="inova logo">
                </div>
                <div class="h--100">
                    <img src="/assets-new/img/logo-bmn.webp" class="h-100" alt="bmn logo">
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column justify-content-center">
                <h3 class="fs-5 mb-3">
                    شبکه های اجتماعی اینوا
                </h3>
                <div class="d-flex align-items-center">
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/bale.svg" alt="rubika" class="img-full">
                    </a>
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/instagram.svg" alt="instagram" class="img-full">
                    </a>
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/bale.svg" alt="bale" class="img-full">
                    </a>
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/telegram.svg" alt="telegram" class="img-full">
                    </a>
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/eitaa.svg" alt="eitaa" class="img-full">
                    </a>
                    <a href="#" class="ratio1-1 w--30 me-3">
                        <img src="/assets-new/img/icons/main/soroush.svg" alt="soroush" class="img-full">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 h-100 d-flex justify-content-end align-items-center my-auto">
                <a href="#" class="border bg-white-10 rounded-3 d-flex p-3 justify-content-center w-fit ">
                    <span class="me-2">ورود | ثبت نام</span>
                    <i class="fi fi-rr-user ms-2"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="/assets-new/js/vendor/bootstrap.bundle.js"></script>
    <script src="/assets-new/js/temp.js"></script>
    <script src="/assets-new/js/slider.js"></script>
    <script>
        let provinces = [
            "همه استان‌ها",
            "آذربایجان شرقی",
            "آذربایجان غربی",
            "اردبیل",
            "اصفهان",
            "البرز",
            "ایلام",
            "بوشهر",
            "تهران",
            "چهارمحال و بختیاری",
            "خراسان جنوبی",
            "خراسان رضوی",
            "خراسان شمالی",
            "خوزستان",
            "زنجان",
            "سمنان",
            "سیستان و بلوچستان",
            "فارس",
            "قزوین",
            "قم",
            "کردستان",
            "کرمان",
            "کرمانشاه",
            "کهگیلویه وبویراحمد",
            "گلستان",
            "گیلان",
            "لرستان",
            "مازندران",
            "مرکزی",
            "هرمزگان",
            "همدان",
            "یزد",
        ];
        makeSelect(".custom-select.s1", provinces)
        makeSlider(".best-slider", ".best-prev", ".best-next");
        // makeSlider(".cards-slider", ".prev1", ".next1");
    </script>
</body>

</html>
