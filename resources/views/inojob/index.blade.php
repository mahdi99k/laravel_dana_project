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
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="row mt-5">
                    <div class="col-xl-7">
                        @foreach ($inojobs as $inojob)
                        <div class="box mb-3" onclick="showPreview(this,{{ $inojob }})">
                            <div class="inner">
                                <div class="row p-3">
                                    <div class="col-3 col-md-2">
                                        <div class="w-100 ratio1-1 bg-white rounded-3 overflow-hidden">
                                            <img src="/assets-new/img/inova.png" class="img-fit w-100" alt="employer">
                                        </div>
                                        <div class="justify-content-center mt-2 align-items-center d-lg-flex d-none">
                                            <i class="fi fi-sr-star text-warning me-1"></i>
                                            <span class="text-warning">4.4</span>
                                        </div>
                                    </div>
                                    <div class="d-flex col justify-content-between fs-md-16 fs-12">
                                        <div class="d-flex flex-column pe-2">
                                            <h3 class="fs-5 line-clamp-1 fs-17 fs-md-20">{{ $inojob->title }}</h3>
                                            {{-- <p class="opacity-50 fs-14">{{ $inojob->emp->name }}</p> --}}
                                            <div>
                                                <span>{{ $inojob->properties->type }}</span>
                                                <span class="mx-2">|</span>
                                                <span class="text-warning">قیمت : {{ $inojob->properties->salary ?? 'بر اساس تعیین دستگاه اجرایی' }}</span>
                                            </div>
                                            <span class="d-block mt-auto opacity-50 fs-12 fs-md-14">
                                                {{jdate($inojob->created_at)->ago()}}
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column justify-content-between align-items-end position-relative">
                                            <i class="fi fi-rr-heart cursor-pointer"></i>
                                            <a href="{{route('inojob-show' , $inojob->id)}}" class="d-flex place-center space-nowrap position-absolute bottom-0 end-0">
                                                <span>مشاهده بیشتر</span>
                                                <i class="fi fi-rr-angle-small-left ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-xl-5">
                        <div class="box border">
                            <div class="inner">
                                <div class="row p-4">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-7 d-flex flex-column">
                                            <h3 class="fs-5" id="inojob-title"></h3>
                                            <span class="opacity-50"></span>
                                            <div class="d-flex align-items-center">
                                                <i class="fi fi-rr-users-alt me-1"></i>
                                                <span class="opacity-50">
                                                    100
                                                    نفر ظرفیت
                                                    (2 روز باقیمانده)
                                                </span>
                                            </div>
                                            <div class="d-lfex align-items-center">
                                                <i class="fi fi-rr-list-check"></i>
                                                <span class="opacity-50">
                                                    بیش از
                                                    100
                                                    درخواست ارسال شده
                                                </span>
                                            </div>
                                            <p>
                                                <span>تمام وثت</span><span class="mx-1">|</span> <span
                                                    class="text-warning">بین 10 تا 15</span>
                                            </p>
                                        </div>
                                        <div class="col-5">
                                            <div class="w-100 ratio1-1 bg-white rounded-3 overflow-hidden">
                                                <img src="/assets-new/img/inova.png" class="img-fit w-100"
                                                    alt="employer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="opacity-50 fs-14">58 روز پیش</span>
                                        <div>
                                            <i class="fi fi-rr-share"></i>
                                            <div class="btn btn-primary">
                                                اضافه کردن به لیست اولویت ها
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-bottom border-secondary"></div>
                                    <ul class="nav custom-nav nav-pills my-3 flex-xxl-nowrap" id="pills-tab" role="tablist">
                                        <li class="nav-item col-xxl-3 col-12" role="presentation">
                                            <button class="w-100 nav-link active h-100" id="pills-home-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                                role="tab" aria-controls="pills-home" aria-selected="true">درباره
                                                شغل</button>
                                        </li>
                                        <li class="nav-item col-xxl-4 col-12 mx-xxl-2 my-xxl-0 my-2" role="presentation">
                                            <button class="w-100 nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">درباره
                                                سازمان</button>
                                        </li>
                                        <li class="nav-item col-xxl-5 col-12" role="presentation">
                                            <button class="w-100 nav-link" id="pills-contact-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-contact" type="button"
                                                role="tab" aria-controls="pills-contact"
                                                aria-selected="false">سایر آگهی‌های سازمان</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            <span class="">نشانی موقعیت شغلی</span> <br>
                                            <span class="fs-14">تهران، آزادی</span>
                                            <div class="row fs-14 flex-wrap g-5 mt-2">
                                                <div class="col-6">
                                                    <div class="d-flex flex-column">
                                                        <span class="mb-1">موقعیت محل کار</span>
                                                        <span class="opacity-50">سرای دکتر غریب</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex flex-column">
                                                        <span class="mb-1">روز و ساعت کاری</span>
                                                        <span class="opacity-50">سرای دکتر غریب</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex flex-column">
                                                        <span class="mb-1">نوع همکاری</span>
                                                        <span class="opacity-50">سرای دکتر غریب</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex flex-column">
                                                        <span class="mb-1">مزایا و تسهیلات</span>
                                                        <span class="opacity-50">سرای دکتر غریب</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 d-flex flex-column">
                                                <span class="fs-5">شرح وظایف</span> 
                                                <span class="opacity-50 mt-1 fs-14 text-justify">دانش های مورد نیاز:Design Tools (e.g., Adobe
                                                    XD, Sketch), Basic HTML/CSSکار با هوش مصنوعی با کمک ابزارهای
                                                    تولید:استفاده از CHAT GPT برای طراحی بازخورد و پیشنهاداتآشنایی با
                                                    مفاهیم رنگ ها،آشنا به الگوهای طراحی و دیزاین سیستم ها ، توانمندی در
                                                    طراحی نقشه راه کاربر و معماری اطلاعات ، آشنایی کامل با یکی از دیزاین
                                                    سیستم های مطرح</span>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            <p>
                                                دانش های مورد نیاز:Design Tools (e.g., Adobe XD, Sketch), Basic
                                                HTML/CSSکار با هوش مصنوعی با کمک ابزارهای تولید:استفاده از CHAT GPT برای
                                                طراحی بازخورد و پیشنهاداتآشنایی با مفاهیم رنگ ها،آشنا به الگوهای طراحی و
                                                دیزاین سیستم ها ، توانمندی در طراحی نقشه راه کاربر و معماری اطلاعات ،
                                                آشنایی کامل با یکی از دیزاین سیستم های مطرح
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab" tabindex="0">se</div>
                                    </div>
                                    
                                    <div class="border-bottom border-secondary my-4"></div>
                                    <div>
                                        <h3 class="mb-2">موقعیت‌های شغلی مشابه</h3>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="inner">
                                                        <div class="row p-3 flex-column">
                                                            <div class="d-flex">
                                                                <div class="col-3 me-2">
                                                                    <div class="w-100 ratio1-1 bg-white rounded-3 overflow-hidden">
                                                                        <img src="/assets-new/img/inova.png" class="img-fit w-100" alt="employer">
                                                                    </div>
                                                                    {{-- <div class="d-flex justify-content-center mt-2 align-items-center">
                                                                        <i class="fi fi-sr-star text-warning me-1"></i>
                                                                        <span class="text-warning">4.4</span>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="d-flex col justify-content-between">
                                                                    <div class="d-flex flex-column">
                                                                        <h3 class="fs-5">مهندسی کامپیوتر</h3>
                                                                        <p class="opacity-50 fs-14">سازمان سنجش و آموزش کشور</p>
                                                                        <div>
                                                                            <span>تمام وقت</span>
                                                                            <span class="mx-2">|</span>
                                                                            <span class="text-warning">بین 10 تا 15</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-between align-items-end">
                                                                        <i class="fi fi-rr-heart cursor-pointer"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="border-bottom border-secondary my-3"></div>
                                                            <div class="d-flex justify-content-between">
                                                                <span class="d-block opacity-50 fs-14">
                                                                    50 روز پیش
                                                                </span>
                                                                <a href="#">
                                                                    <span>مشاهده بیشتر</span>
                                                                    <i class="fi fi-rr-angle-small-left ms-1"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>
    <script src="/assets/js/inoje/datalist-css.min.js"></script>
    <script src="/assets-new/js/vendor/bootstrap.bundle.js"></script>
    <script src="/assets-new/js/temp.js"></script>


    <script>
        let activeBox;
         function showPreview(el,inojob) {
            el.classList.add("active")
            if(activeBox) activeBox.classList.remove("active")
            activeBox = el;
            $("inojob-title" , "id").textContent = inojob.title;
        }
    </script>
</body>

</html>
