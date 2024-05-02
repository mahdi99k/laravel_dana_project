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
            <div class="con position-relative d-flex align-items-center justify-content-between h-100">
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
        </section>
    </header>
    <main>

        <div class="container">

            <div class="row justify-content-center align-items-center position-relative">
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
                        <div class="label-white">
                            مشاهده همه
                        </div>
                        <div class="d-flex scroll-buttons justify-content-between mt-1">
                            <div class="bg-white-10 rounded-3">
                                <i class="fi fi-rr-angle-small-right fs-3"></i>
                            </div>
                            <div class="bg-white-10 rounded-3">
                                <i class="fi fi-rr-angle-small-left fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden col-12">
                    <div class="row flex-nowrap justify-content-between best-slider overflow-auto no-scrollbar">
                        <div class="col-xl-4 col-md-7 col-sm-9 col-12">
                                <div class="box">
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
                                <div class="box">
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
                                <div class="box">
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

            <div class="row">
                <div class="">
                    <div class="position-relative">
                        <input type="text" name="" id="test" class="has-label" required>
                        <label for="" class="label-before">استان محل کار</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، لازم است،
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                                data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
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
                </div>
            </div>
            <div class="row">
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
                                <input type="checkbox" id="check1" name="radio">
                                <label for="check1">تست 1</label>
                                <input type="checkbox" id="check2" name="radio">
                                <label for="check2">تست 2</label>
                                <input type="checkbox" id="check3" name="radio">
                                <label for="check3">تست 3</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="custom-select s1">
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
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </main>
    <script src="/assets-new/js/vendor/bootstrap.bundle.js"></script>
    <script src="/assets-new/js/temp.js"></script>
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
        makeSlider(".best-slider");
        // makeSlider(".cards-slider", ".prev1", ".next1");
    </script>
</body>

</html>
