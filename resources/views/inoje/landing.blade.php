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
      (e.onload = function () {
        var A = 0 < e.width && 0 < e.height;
        a(A);
      }),
        (e.onerror = function () {
          a(!1);
        }),
        (e.src =
          "data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==");
    }
    (avif.src =
      "data:image/avif;base64,AAAAIGZ0eXBhdmlmAAAAAGF2aWZtaWYxbWlhZk1BMUIAAADybWV0YQAAAAAAAAAoaGRscgAAAAAAAAAAcGljdAAAAAAAAAAAAAAAAGxpYmF2aWYAAAAADnBpdG0AAAAAAAEAAAAeaWxvYwAAAABEAAABAAEAAAABAAABGgAAAB0AAAAoaWluZgAAAAAAAQAAABppbmZlAgAAAAABAABhdjAxQ29sb3IAAAAAamlwcnAAAABLaXBjbwAAABRpc3BlAAAAAAAAAAIAAAACAAAAEHBpeGkAAAAAAwgICAAAAAxhdjFDgQ0MAAAAABNjb2xybmNseAACAAIAAYAAAAAXaXBtYQAAAAAAAAABAAEEAQKDBAAAACVtZGF0EgAKCBgANogQEAwgMg8f8D///8WfhwB8+ErK42A="),
      (avif.onload = function () {
        addClass("avif");
      }),
      (avif.onerror = function () {
        check_webp_feature(function (A) {
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
      <div data-slide="2" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="3" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="4" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="5" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="6" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="7" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="8" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
      <div data-slide="9" class="hero-bg position-absolute pe-none user-selec-none h-100 w-100 top-0 start-0"></div>
    </section>

    <section id="hero">
      <div class="con position-relative h-100">
        <div class="d-flex justify-content-lg-start justify-content-center position-relative hero-intro-con">
          <div
            class="hero-line fadeinDownDelay h-100 position-absolute start-0 d-flex flex-column justify-content-center">
            <span class="slider-counter">01</span>
            <div class="hero-line-all h-100 w-100 position-relative bg-white-50 rounded-pill my-2">
              <div class="position-absolute bg-white rounded-pill w-100 hero-line-fill" style="--slide: 1"></div>
            </div>
            <span>09</span>
          </div>
          <div class="hero-intro fadeinRightDelay px-2 h-100 d-flex flex-column justify-content-between">
            <div>
              <h1 class="text-bold">اینوژه /</h1>
              <div class="position-relative title-con d-flex justify-content-lg-start justify-content-center"
                id="titles">
                <div class="top-0 titleAll opacity-100">
                  <h3 class="title">هوش مصنوعی</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی را با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title">خودرو</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی را2 با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title title-sm">نفت‌ و گاز پتروشیمی</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی ر3ا با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title title-sm">مواد و ساخت پیشرفته</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی ر4ا با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title title-sm">کشاورزی و امنیت غذایی</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی ر5ا با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title">امنیت سایبری</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی ر6ا با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title">ماشین سازی</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی را 7با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title">هوافضا</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی 8 با اینوا درک کن</p>
                </div>
                <div class="position-absolute top-0 titleAll">
                  <h3 class="title">حمل و نقل</h3>
                  <p class="mt-4">جذابیت هوش مصنوعی 9را با اینوا درک کن</p>
                </div>
              </div>
            </div>

            <!-- <a href="#">
              <span class="d-none d-lg-inline">مشاهده همه</span>
              <i class="fi fi-rr-angle-circle-down ms-2"></i>
            </a> -->
            
          </div>
        </div>
        <form class="d-flex col-11 col-sm-8 col-lg-6 col-xl-4 rounded-pill search-blur-box mt-2 mt-lg-5 mx-lg-0 mx-auto">
              <input type="text" name="search" class="col bg-transparent border-none outline-none p-2 placeholder-light text-white ps-4" placeholder="دنبال چه اینوژه ای میگردی؟">
              <button type="submit" class="linear-purple rounded-circle w-50p place-center text-white border-none outline-none"><i class="fi-rr-search fs-3 place-center"></i></button>
        </form>
        <div
          class="hero-downside fadeinUpDelay d-none d-lg-flex con w-100 end-0 justify-content-between align-items-end position-absolute bottom-0">
          <div class="hero-counter-con">
            <div class="hero-counter">
              <span class="slider-counter">01</span>
              <span class="opacity-50">/09</span>
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
            <div class="hero-slider-top d-flex justify-content-between">
              <div class="hero-slider-toggle dir-ltr cursor-default">
                <span class="rounded-circle cursor-pointer bg-white-50 bg-white"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
                <span class="rounded-circle cursor-pointer bg-white-50"></span>
              </div>
              <p class="text-underline">سایر دسته‌بندی‌ها</p>
            </div>
            <div class="hero-slider d-flex justify-content-between align-items-center dir-ltr">
              <div class="hero-slider-img cursor-pointer" style="--slide: -1"></div>
              <div class="hero-slider-img cursor-pointer" style="--slide: 0"></div>
              <div class="hero-slider-img cursor-pointer" style="--slide: 1"></div>
            </div>
            <p class="text-justify">
              لورم ایپسوم متن ساختگی بدون مفهوم برای طراحان گرافیک و صنعت چاپ
              است. لورم ایپسوم متن ساختگی بدون مفهوم برای طراحان گرافیک و صنعت
              چاپ است
            </p>
          </div>
        </div>
      </div>
    </section>
  </header>
  <main>
    <div class="con">
      <div class="d-flex align-items-end justify-content-between mt-5">
        <div>
          <span class="opacity-50">اینارو ما پین کردیم</span>
          <h4 class="title fs-1">اینوژه های ویژه</h4>
        </div>
        <div>
          <button type="button" class="p-0 btn text-white outline-none me-sm-3 me-1 next1"><i
              class="fi fi-rr-angle-circle-right  fs-30 fs-sm-45"></i></button>
          <button type="button" class="p-0 btn text-white outline-none prev1"><i
              class="fi fi-rr-angle-circle-left fs-30 fs-sm-45"></i></button>
        </div>
      </div>
      <div class="mw-100 overflow-x-scroll pt-5 cards-slider">
        <div class="row justify-content-sm-between flex-nowrap ">
   
        
        </div>
      </div>
    </div>
    <div class="con mt-170">
      <div class="d-flex flex-wrap align-items-end justify-content-sm-between justify-content-center">
        <div class="heading">
          <span class="opacity-50">ترندترین دسته‌بندی های اینوژه</span>
          <h4 class="title fs-1">ترند ها</h4>
        </div>
        <div class=" d-none d-xxl-block">
          <!-- <ul class="list-inline opacity-50 tab-options">
            <li class="list-inline-item active">همه</li>
            <li class="list-inline-item">هوش مصنوعی</li>
            <li class="list-inline-item">خودرو</li>
            <li class="list-inline-item">حمل و نقل</li>
          </ul> -->
          <div class="dir-ltr">
            <div class="tabs">
              <input value="all" type="radio" id="radio-1" name="tabs" checked />
              <label class="tab" for="radio-1">همه ترندها
                <!-- <span class="notification">2</span> -->
              </label>
              <input value="1" type="radio" id="radio-2" name="tabs" />
              <label class="tab" for="radio-2">هوش مصنوعی</label>
              <input value="2" type="radio" id="radio-3" name="tabs" />
              <label class="tab" for="radio-3">نفت و گاز پتروشیمی</label>
              <input value="3" type="radio" id="radio-4" name="tabs" />
              <label class="tab" for="radio-4">کشاورزی و امنیت غذایی</label>
              <!-- <input value="4" type="radio" id="radio-5" name="tabs" />
              <label class="tab" for="radio-5">خودرو</label> -->
              <span class="glider" id="glider"></span>
            </div>
          </div>
          
        </div>
        <div class="col-sm-5 col-12 d-block d-xxl-none ">
        <select class="mt-sm-0 mt-3 w-100 form-select linear-purple text-white border-none select-linear" onchange="trendWrapper(this)">
                    <option value="all">همه ترندها</option>
                    <option value="1">هوش مصنوعی</option>
                    <option value="2">نفت و گاز پتروشیمی</option>
                    <option value="3">کشاورزی و امنیت غذایی</option>
                  </select>
        </div>
      </div>
      <div class=" mw-100 pt-5">
        <div class="row gy-4 trends">
          <div  data-cat="1" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/1.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="1 2" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/2.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="3" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/3.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="3" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/4.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="1 2" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/5.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="1" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/6.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="3 2" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/7.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>
          <div  data-cat="1 2" class="col-xxl-3 col-md-6 col-12 trend-card">
            <div class="box" data-state="#about">
              <div class="box-header">
                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none"
                  src="/assets-new/img/activities/inoje/avif/8.avif">
                <img class="box-avatar img-full pe-none" src="/assets-new/img/inova.png" alt="avatar" />
                <span class="box-jobtitle">مرکز شتاب‌دهی</span>
                <a href="#">
                  <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
                </a>
              </div>
              <div class="box-main">
                <div class="box-section is-active" id="about">
                  <div class="box-content">
                    <div class="box-subtitle">درباره این اینوژه</div>
                    <p class="box-desc line-clamp-4">
                      لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان
                      گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن
                      ساختگی برای طراحان گرافیک و صنعت چاپ است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ
                      است. لورم ایپسوم متن ساختگی برای طراحان گرافیک و صنعت چاپ است.
                    </p>
                  </div>
                </div>
                <div class="box-section" id="timeline">
                  <div class="box-content">
                    <span class="box-subtitle">وضعیت پروژه:</span>
                    <span class="box-item-desc">درحال اخذ پروپوزال</span>
                    <div class="box-timeline">
                      <div class="box-item" data-year="2014">
                        <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2016">
                        <div class="box-item-title">مهلت ارسال پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2018">
                        <div class="box-item-title">مهلت داوری پروپوزال</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                      <div class="box-item" data-year="2020">
                        <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                        <div class="box-item-desc">08 تیر 1403</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-section" id="contact">
                  <div class="box-content">
                    <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                    <div class="box-contact-wrapper">
                      <div class="box-contact">
                        مهندسی کامپیوتر
                      </div>
                      <div class="box-contact">
                        (269) 756-9809
                      </div>
                      <div class="box-contact">
                        william@rocheald.com
                      </div>
                      <button class="contact-me">ارسال پروپوزال</button>
                    </div>
                  </div>
                </div>
                <div class="box-buttons">
                  <button data-section="#about" class="is-active">اطلاعات</button>
                  <button data-section="#timeline">زمانبندی</button>
                  <button data-section="#contact">پروپوزال</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- <div class="con mw-100 pt-5">
      <div class="row gy-4">
        <div class="col-xxl-3 col-md-6 col-12">
          <div class="box" data-state="#about">
            <div class="box-header">
              <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit"
                src="/assets-new/img/activities/inoje/avif/1.avif">
              <img class="box-avatar img-full" src="/assets-new/img/inova.png" alt="avatar" />
              <span class="box-jobtitle">مرکز شتاب‌دهی</span>
              <a class="#">
                <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
              </a>
            </div>
            <div class="box-main">
              <div class="box-section is-active" id="about">
                <div class="box-content">
                  <div class="box-subtitle">اطلاعات</div>
                  <p class="box-desc">Whatever tattooed stumptown art party sriracha gentrify hashtag intelligentsia
                    readymade schlitz brooklyn disrupt.
                  </p>
                </div>
                <div class="box-social">
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z" />
                    </svg></a>
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path
                        d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M301 256c0 24.852-20.148 45-45 45s-45-20.148-45-45 20.148-45 45-45 45 20.148 45 45zm0 0" />
                      <path
                        d="M332 120H180c-33.086 0-60 26.914-60 60v152c0 33.086 26.914 60 60 60h152c33.086 0 60-26.914 60-60V180c0-33.086-26.914-60-60-60zm-76 211c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm86-146c-8.285 0-15-6.715-15-15s6.715-15 15-15 15 6.715 15 15-6.715 15-15 15zm0 0" />
                      <path
                        d="M377 0H135C60.562 0 0 60.563 0 135v242c0 74.438 60.563 135 135 135h242c74.438 0 135-60.563 135-135V135C512 60.562 451.437 0 377 0zm45 332c0 49.625-40.375 90-90 90H180c-49.625 0-90-40.375-90-90V180c0-49.625 40.375-90 90-90h152c49.625 0 90 40.375 90 90zm0 0" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909A2.884 2.884 0 002.882 0z" />
                    </svg></a>
                </div>
              </div>
              <div class="box-section" id="timeline">
                <div class="box-content">
                  <div class="box-subtitle">WORK timeline</div>
                  <div class="box-timeline">
                    <div class="box-item" data-year="2014">
                      <div class="box-item-title">Front-end Developer at <span>JotForm</span></div>
                      <div class="box-item-desc">Disrupt stumptown retro everyday carry unicorn.</div>
                    </div>
                    <div class="box-item" data-year="2016">
                      <div class="box-item-title">UI Developer at <span>GitHub</span></div>
                      <div class="box-item-desc">Developed new conversion funnels and disrupt.</div>
                    </div>
                    <div class="box-item" data-year="2018">
                      <div class="box-item-title">Illustrator at <span>Google</span></div>
                      <div class="box-item-desc">Onboarding illustrations for App.</div>
                    </div>
                    <div class="box-item" data-year="2020">
                      <div class="box-item-title">Full-Stack Developer at <span>CodePen</span></div>
                      <div class="box-item-desc">Responsible for the encomposing brand expreience.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-section" id="contact">
                <div class="box-content">
                  <div class="box-subtitle">CONTACT</div>
                  <div class="box-contact-wrapper">
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                      </svg>
                      Algonquin Rd, Three Oaks Vintage, MI, 49128
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                          d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                      </svg>(269) 756-9809
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <path d="M22 6l-10 7L2 6" />
                      </svg>
                      william@rocheald.com
                    </div>
                    <button class="contact-me">WORK TOGETHER</button>
                  </div>
                </div>
              </div>
              <div class="box-buttons">
                <button data-section="#about" class="is-active">ABOUT</button>
                <button data-section="#timeline">timeline</button>
                <button data-section="#contact">CONTACT</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-12">
          <div class="box" data-state="#about">
            <div class="box-header">
              <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit"
                src="/assets-new/img/activities/inoje/avif/1.avif">
              <img class="box-avatar img-full" src="/assets-new/img/inova.png" alt="avatar" />
              <span class="box-jobtitle">مرکز شتاب‌دهی</span>
              <a class="#">
                <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
              </a>
            </div>
            <div class="box-main">
              <div class="box-section is-active" id="about">
                <div class="box-content">
                  <div class="box-subtitle">اطلاعات</div>
                  <p class="box-desc">Whatever tattooed stumptown art party sriracha gentrify hashtag intelligentsia
                    readymade schlitz brooklyn disrupt.
                  </p>
                </div>
                <div class="box-social">
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z" />
                    </svg></a>
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path
                        d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M301 256c0 24.852-20.148 45-45 45s-45-20.148-45-45 20.148-45 45-45 45 20.148 45 45zm0 0" />
                      <path
                        d="M332 120H180c-33.086 0-60 26.914-60 60v152c0 33.086 26.914 60 60 60h152c33.086 0 60-26.914 60-60V180c0-33.086-26.914-60-60-60zm-76 211c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm86-146c-8.285 0-15-6.715-15-15s6.715-15 15-15 15 6.715 15 15-6.715 15-15 15zm0 0" />
                      <path
                        d="M377 0H135C60.562 0 0 60.563 0 135v242c0 74.438 60.563 135 135 135h242c74.438 0 135-60.563 135-135V135C512 60.562 451.437 0 377 0zm45 332c0 49.625-40.375 90-90 90H180c-49.625 0-90-40.375-90-90V180c0-49.625 40.375-90 90-90h152c49.625 0 90 40.375 90 90zm0 0" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909A2.884 2.884 0 002.882 0z" />
                    </svg></a>
                </div>
              </div>
              <div class="box-section" id="timeline">
                <div class="box-content">
                  <div class="box-subtitle">WORK timeline</div>
                  <div class="box-timeline">
                    <div class="box-item" data-year="2014">
                      <div class="box-item-title">Front-end Developer at <span>JotForm</span></div>
                      <div class="box-item-desc">Disrupt stumptown retro everyday carry unicorn.</div>
                    </div>
                    <div class="box-item" data-year="2016">
                      <div class="box-item-title">UI Developer at <span>GitHub</span></div>
                      <div class="box-item-desc">Developed new conversion funnels and disrupt.</div>
                    </div>
                    <div class="box-item" data-year="2018">
                      <div class="box-item-title">Illustrator at <span>Google</span></div>
                      <div class="box-item-desc">Onboarding illustrations for App.</div>
                    </div>
                    <div class="box-item" data-year="2020">
                      <div class="box-item-title">Full-Stack Developer at <span>CodePen</span></div>
                      <div class="box-item-desc">Responsible for the encomposing brand expreience.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-section" id="contact">
                <div class="box-content">
                  <div class="box-subtitle">CONTACT</div>
                  <div class="box-contact-wrapper">
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                      </svg>
                      Algonquin Rd, Three Oaks Vintage, MI, 49128
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                          d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                      </svg>(269) 756-9809
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <path d="M22 6l-10 7L2 6" />
                      </svg>
                      william@rocheald.com
                    </div>
                    <button class="contact-me">WORK TOGETHER</button>
                  </div>
                </div>
              </div>
              <div class="box-buttons">
                <button data-section="#about" class="is-active">ABOUT</button>
                <button data-section="#timeline">timeline</button>
                <button data-section="#contact">CONTACT</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-12">
          <div class="box" data-state="#about">
            <div class="box-header">
              <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit"
                src="/assets-new/img/activities/inoje/avif/1.avif">
              <img class="box-avatar img-full" src="/assets-new/img/inova.png" alt="avatar" />
              <span class="box-jobtitle">مرکز شتاب‌دهی</span>
              <a class="#">
                <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
              </a>
            </div>
            <div class="box-main">
              <div class="box-section is-active" id="about">
                <div class="box-content">
                  <div class="box-subtitle">اطلاعات</div>
                  <p class="box-desc">Whatever tattooed stumptown art party sriracha gentrify hashtag intelligentsia
                    readymade schlitz brooklyn disrupt.
                  </p>
                </div>
                <div class="box-social">
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z" />
                    </svg></a>
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path
                        d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M301 256c0 24.852-20.148 45-45 45s-45-20.148-45-45 20.148-45 45-45 45 20.148 45 45zm0 0" />
                      <path
                        d="M332 120H180c-33.086 0-60 26.914-60 60v152c0 33.086 26.914 60 60 60h152c33.086 0 60-26.914 60-60V180c0-33.086-26.914-60-60-60zm-76 211c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm86-146c-8.285 0-15-6.715-15-15s6.715-15 15-15 15 6.715 15 15-6.715 15-15 15zm0 0" />
                      <path
                        d="M377 0H135C60.562 0 0 60.563 0 135v242c0 74.438 60.563 135 135 135h242c74.438 0 135-60.563 135-135V135C512 60.562 451.437 0 377 0zm45 332c0 49.625-40.375 90-90 90H180c-49.625 0-90-40.375-90-90V180c0-49.625 40.375-90 90-90h152c49.625 0 90 40.375 90 90zm0 0" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909A2.884 2.884 0 002.882 0z" />
                    </svg></a>
                </div>
              </div>
              <div class="box-section" id="timeline">
                <div class="box-content">
                  <div class="box-subtitle">WORK timeline</div>
                  <div class="box-timeline">
                    <div class="box-item" data-year="2014">
                      <div class="box-item-title">Front-end Developer at <span>JotForm</span></div>
                      <div class="box-item-desc">Disrupt stumptown retro everyday carry unicorn.</div>
                    </div>
                    <div class="box-item" data-year="2016">
                      <div class="box-item-title">UI Developer at <span>GitHub</span></div>
                      <div class="box-item-desc">Developed new conversion funnels and disrupt.</div>
                    </div>
                    <div class="box-item" data-year="2018">
                      <div class="box-item-title">Illustrator at <span>Google</span></div>
                      <div class="box-item-desc">Onboarding illustrations for App.</div>
                    </div>
                    <div class="box-item" data-year="2020">
                      <div class="box-item-title">Full-Stack Developer at <span>CodePen</span></div>
                      <div class="box-item-desc">Responsible for the encomposing brand expreience.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-section" id="contact">
                <div class="box-content">
                  <div class="box-subtitle">CONTACT</div>
                  <div class="box-contact-wrapper">
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                      </svg>
                      Algonquin Rd, Three Oaks Vintage, MI, 49128
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                          d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                      </svg>(269) 756-9809
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <path d="M22 6l-10 7L2 6" />
                      </svg>
                      william@rocheald.com
                    </div>
                    <button class="contact-me">WORK TOGETHER</button>
                  </div>
                </div>
              </div>
              <div class="box-buttons">
                <button data-section="#about" class="is-active">ABOUT</button>
                <button data-section="#timeline">timeline</button>
                <button data-section="#contact">CONTACT</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-12">
          <div class="box" data-state="#about">
            <div class="box-header">
              <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit"
                src="/assets-new/img/activities/inoje/avif/1.avif">
              <img class="box-avatar img-full" src="/assets-new/img/inova.png" alt="avatar" />
              <span class="box-jobtitle">مرکز شتاب‌دهی</span>
              <a class="#">
                <h4 class="box-fullname line-clamp-1">طراحی و ساخت راکتور ویژه هسته‌ای بسیار جادار</h4>
              </a>
            </div>
            <div class="box-main">
              <div class="box-section is-active" id="about">
                <div class="box-content">
                  <div class="box-subtitle">اطلاعات</div>
                  <p class="box-desc">Whatever tattooed stumptown art party sriracha gentrify hashtag intelligentsia
                    readymade schlitz brooklyn disrupt.
                  </p>
                </div>
                <div class="box-social">
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z" />
                    </svg></a>
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path
                        d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M301 256c0 24.852-20.148 45-45 45s-45-20.148-45-45 20.148-45 45-45 45 20.148 45 45zm0 0" />
                      <path
                        d="M332 120H180c-33.086 0-60 26.914-60 60v152c0 33.086 26.914 60 60 60h152c33.086 0 60-26.914 60-60V180c0-33.086-26.914-60-60-60zm-76 211c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm86-146c-8.285 0-15-6.715-15-15s6.715-15 15-15 15 6.715 15 15-6.715 15-15 15zm0 0" />
                      <path
                        d="M377 0H135C60.562 0 0 60.563 0 135v242c0 74.438 60.563 135 135 135h242c74.438 0 135-60.563 135-135V135C512 60.562 451.437 0 377 0zm45 332c0 49.625-40.375 90-90 90H180c-49.625 0-90-40.375-90-90V180c0-49.625 40.375-90 90-90h152c49.625 0 90 40.375 90 90zm0 0" />
                    </svg></a>
                  <a href="#"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909A2.884 2.884 0 002.882 0z" />
                    </svg></a>
                </div>
              </div>
              <div class="box-section" id="timeline">
                <div class="box-content">
                  <div class="box-subtitle">WORK timeline</div>
                  <div class="box-timeline">
                    <div class="box-item" data-year="2014">
                      <div class="box-item-title">Front-end Developer at <span>JotForm</span></div>
                      <div class="box-item-desc">Disrupt stumptown retro everyday carry unicorn.</div>
                    </div>
                    <div class="box-item" data-year="2016">
                      <div class="box-item-title">UI Developer at <span>GitHub</span></div>
                      <div class="box-item-desc">Developed new conversion funnels and disrupt.</div>
                    </div>
                    <div class="box-item" data-year="2018">
                      <div class="box-item-title">Illustrator at <span>Google</span></div>
                      <div class="box-item-desc">Onboarding illustrations for App.</div>
                    </div>
                    <div class="box-item" data-year="2020">
                      <div class="box-item-title">Full-Stack Developer at <span>CodePen</span></div>
                      <div class="box-item-desc">Responsible for the encomposing brand expreience.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-section" id="contact">
                <div class="box-content">
                  <div class="box-subtitle">CONTACT</div>
                  <div class="box-contact-wrapper">
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                      </svg>
                      Algonquin Rd, Three Oaks Vintage, MI, 49128
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                          d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                      </svg>(269) 756-9809
                    </div>
                    <div class="box-contact">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <path d="M22 6l-10 7L2 6" />
                      </svg>
                      william@rocheald.com
                    </div>
                    <button class="contact-me">WORK TOGETHER</button>
                  </div>
                </div>
              </div>
              <div class="box-buttons">
                <button data-section="#about" class="is-active">ABOUT</button>
                <button data-section="#timeline">timeline</button>
                <button data-section="#contact">CONTACT</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    
  </main>

  <script src="/assets-new/js/temp.js"></script>
  <script>
    makeSlider(".cards-slider", ".prev1", ".next1");
  </script>
</body>

</html>