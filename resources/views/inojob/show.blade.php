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
    <main class="mt-5">
        <div class="row flex-column container mx-auto g-xl-3 g-1 flex-wrap pt-5">
            <div class="col-12">
                <div class="box">
                    <div class="inner">
                        <div class="row flex-column">
                            <div class="col-12 h--130 overflow-hidden d-none d-md-block">
                                <img src="/assets-new/img/activities/inojob/webp/1.webp" class="w-100 img-fit" alt="bg">
                            </div>
                            <div class="col-12 p-4 d-flex align-items-stretch">
                                <div class="col-md-1 col-2 d-flex flex-column me-2 justify-content-center">
                                    <div class="rounded-circle w-100 ratio1-1 border border-secondary border-4 place-center overflow-hidden bg-white mt--n-md-30">
                                        <img src="/assets-new/img/inova.png" alt="employer" class="w-100 img-fit">
                                    </div>
                                    <div class="d-none d-md-flex justify-content-center mt-2 align-items-center">
                                        <i class="fi fi-sr-star text-warning me-1"></i>
                                        <span class="text-warning">4.4</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <div class="col-md-10 d-flex flex-column">
                                        <h2 class="fs-md-5 fs-17 line-clamp-1 pe-1">{{$inojob->title}}</h2>
                                        <span class="mt-1 fs-14 opacity-50">سازمان سنجش</span>
                                        <div class="mt-3 fs-12 fs-md-20">
                                            <span>{{$inojob->properties->type}}</span>
                                            <span class="mx-2">|</span>
                                            <span class="text-warning">قیمت : {{ $inojob->properties->salary ?? 'بر اساس تعیین دستگاه اجرایی' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-2 p-1 d-none d-md-block">
                                        <div class="d-flex flex-column justify-content-between h-75">
                                            <div class="justify-content-end d-flex">
                                                <i class="fi fi-rr-share fs-4 me-3"></i>
                                                <i class="fi fi-rr-heart fs-4 ms-1 cursor-pointer"></i>
                                            </div>
                                            <span class="opacity-50 fs-14 mt-auto d-block text-end">{{jdate($inojob->created_at)->ago()}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-xl-3 g-1 pt-3">
                <div class="col-xl-9">
                    <div class="box">
                        <div class="inner">
                            <div class="row p-4">
                                <div class="bg-white-10 rounded-3 p-3 fs-5">
                                    مشخصات موقعیت شغلی
                                </div>
                                <div class="row flex-wrap g-3">
                                    <!-- <div class="col-sm-6 d-flex flex-column">
                                        <span>روز و ساعت کاری</span>
                                        <span class="mt-1 fs-14 opacity-50">تست</span>
                                    </div> -->
                                    <!-- <div class="col-sm-6 d-flex flex-column">
                                        <span>نوع همکاری</span>
                                        <span class="mt-1 fs-14 opacity-50"></span>
                                    </div> -->
                                    <!-- <div class="col-sm-6 d-flex flex-column">
                                        <span>شرایط احراز شغل</span>
                                        <span class="mt-1 fs-14 opacity-50">تست</span>
                                    </div> -->
                                    <div class="col-sm-6 d-flex flex-column">
                                        <span>مزایا و تصحیلات</span>
                                        <span class="mt-1 fs-14 opacity-50">
                                            {{ implode(', ', $inojob->facilities) }}
                                        </span>
                                    </div>
                                    <!-- <div class="col-sm-6 d-flex flex-column">
                                        <span>سفر های کاری</span>
                                        <span class="mt-1 fs-14 opacity-50">تست</span>
                                    </div> -->
                                    <div class="col-sm-6 d-flex flex-column">
                                        <span>شرح شغل</span>
                                        <p class="mt-1 fs-14 opacity-50">
                                            @if($inojob->description)
                                                {!! $inojob->description !!}
                                            @else   
                                            این موقعیت شغلی تحت عنوان "{{$inojob->title}}" 
                                            توسط {{$inojob->employer->name}} در زیر گروه {{'setad'}} 
                                            ثبت گردیده و برای دسته بندی جذب دستگاه های دولتی قرار دارد.
                                            همچنین برای افراد 
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-sm-6 d-flex flex-column">
                                        <span>درباره سازمان شرکت</span>
                                        <span class="mt-1 fs-14 opacity-50">

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="d-flex flex-column">
                        <div class="mb-3">
                            <div class="box">
                                <div class="inner">
                                    <div class="d-flex flex-column">
                                        <div class="bg-white-10 p-3 fs-5">
                                            ارسال رزومه
                                        </div>
                                    </div>
                                    <div class="p-2 d-flex flex-column">
                                        <div class="border rounded-2 p-3 d-flex flex-column">
                                            <span>رزومه نسترن</span>
                                            <span class="opacity-50 mt-1">طراحی وب</span>
                                        </div>
                                        <a href="#" class="d-flex justify-content-center my-3 align-items-center">
                                            <span>مشاهده رزومه</span>
                                            <i class="fi fi-rr-angle-small-left ms-1"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="box">
                                <div class="inner">
                                    <div class="d-flex flex-column">
                                        <div class="bg-white-10 p-3 fs-5">
                                           موقعیت های شغلی انتخاب شده
                                        </div>
                                    </div>
                                    <div class="p-2 d-flex flex-column">
                                        <div class="d-flex flex-column">
                                            <div class="bg-white-05 rounded-2 d-flex p-2 align-items-center my-2">
                                                <i class="fi fi-rr-bars-sort fs-4"></i>
                                                <div class="d-flex flex-column ms-3">
                                                    <span>شغل اول</span>
                                                    <span class="opacity-50 fs-14">سازمان</span>
                                                </div>
                                            </div>
                                            <div class="bg-white-05 rounded-2 d-flex p-2 align-items-center my-2">
                                                <i class="fi fi-rr-bars-sort fs-4"></i>
                                                <div class="d-flex flex-column ms-3">
                                                    <span>شغل اول</span>
                                                    <span class="opacity-50 fs-14">سازمان</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="d-flex justify-content-center my-3 align-items-center">
                                            <span>مشاهده رزومه</span>
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


    </main>
    <script src="/assets/js/inoje/datalist-css.min.js"></script>
    <script src="/assets-new/js/vendor/bootstrap.bundle.js"></script>
    <script src="/assets-new/js/temp.js"></script>

</body>

</html>
