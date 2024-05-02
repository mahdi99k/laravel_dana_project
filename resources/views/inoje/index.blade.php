@extends('layouts')
@section('content')
{{-- @dd($projects); --}}
<br />
<br />
<br />
<br />
<br />
{{-- <?

// $search_res = [
//     1 => "python",
//     2 => "js",
//     3 => "php",
//     4 => "angular",
//     5 => "view",
//     6 => "react",
//     7 => "android",
//     8 => "html",
//     9 => "css",
//     10 => "python",
// ]
?> --}}
<div class="row con">
    <div id="rightsidebar" class="col-xl-4 col-md-4">


        <script type="text/javascript">
            $(document).ready(function() {
                $(".start_date").pDatepicker({
                    initialValue: false
                });
                $(".end_date").pDatepicker({
                    initialValue: false
                });
            });
        </script>
        <div class="filter_ctn_box">
            <div class="filter_header">
                <div class="filter_header_title">فیلتر جستجو</div>
                <div class="revert_btn filter_header_button" onclick="revertFilter()">
                    <img src="assets-new/img/activities/inoje/restore_filter.png" />
                    بازگردانی فیلترها
                </div>
            </div>
            <form>
                <div>
                    <div class="item_filter">
                        <div class="item_filter_lable">
                            نوع پروژه
                        </div>
                        <div class="row">
        
                            <div class="col">
                                <input type="radio" name="projec_type" id="outline" class="custom-radio">
                                <label for="outline">همه</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="projec_type" id="outline" class="custom-radio">
                                <label for="outline">دانشی</label>
                            </div>
                            <div class="col">
                                  <input type="radio" name="projec_type" id="outline" class="custom-radio">
                                <label for="outline">بنیادی</label>
                            </div>
                            <div class="col">
                                  <input type="radio" name="projec_type" id="outline" class="custom-radio">
                                <label for="outline">فناورانه</label>
                            </div>
                        </div>
                    </div>
        
                    <div class="item_filter">
                        <div class="item_filter_lable">
                            بازه قیمتی
                        </div>
                        <br />
                        <br />
                        <div class="double-range-wrapper dir-rtl">
                            <div>
                                <div class="values" style="float: left;">
                                    <span id="range1">0</span>
                                </div>
                                <div class="values" style="float: right;">
                                    <span id="range2">1200  </span>
                                </div>
                            </div>
        
                            <div class="container">
                                <div class="slider-track">
                                </div>
                                <input class="dir-ltr" type="range" name="slider-2" min="0" max="1200" value="1200" id="slider-2" oninput="slideTwo()">
                                <input class="dir-ltr" type="range" name="slider-1" min="0" max="1200" value="0" id="slider-1" oninput="slideOne()">
                            </div>
                        </div>
                    </div>
                    <div class="item_filter">
                        <div class="item_filter_lable">
                            تخصص ها
                        </div>
                        <div>
                            <input type="text" placeholder="تخصص ها را انتخاب کنید" list="major" id="major_input" class="custome_input revert" />
                            <datalist id="major">
                            
                            </datalist>
                        </div>
                        <br />
                        <div>
                            <span style="background-color: #ACACAC;padding:2px 8px;border-radius: 8px;margin: 3px;">
                                <img src="assets-new/img/activities/inoje/close.png" />
                                مهندسی برق
                            </span>
                            <span style="background-color: #ACACAC;padding:2px 8px;border-radius: 8px;margin: 3px;">
                                <img src="assets-new/img/activities/inoje/close.png" />
                                مهندسی پزشکی
                            </span>
                        </div>
        
                    </div>
                    <div class="item_filter">
                        <div class="item_filter_lable">
                            دسته بندی ها
                        </div>
                        <div>
                            <select id="category" class="custome_input">
                                <option value="none"> انتخاب </option>
                                <option value="0"> دسته بندی ها را انتخاب کنید</option>
                                <option value="1"> دسته بندی ها را انتخاب کنید</option>
                            </select>
                        </div>
                        <br />
                        <div>
                            <span style="background-color: #ACACAC;padding:2px 8px;border-radius: 8px;margin: 3px;">
                                <img src="assets-new/img/activities/inoje/close.png" />
                                مهندسی برق
                            </span>
                            <span style="background-color: #ACACAC;padding:2px 8px;border-radius: 8px;margin: 3px;">
                                <img src="assets-new/img/activities/inoje/close.png" />
                                مهندسی پزشکی
                            </span>
                        </div>
        
                    </div>
                    <div class="item_filter">
                        <div class="item_filter_lable">
                            زمان بندی
                        </div>
                        <div style="position: relative;" class="calender">
                            <input class="start_date date_revert custome_input" type="text" />
                            <i class="fi fi-rr-calendar"></i>
                            <div class="from">از تاریخ :</div>
                            <input class="end_date date_revert custome_input" type="text" />
                            <i class="fi fi-rr-calendar"></i>
                            <div class="to">تا تاریخ :</div>
                        </div>
                        <br />
                    </div>
                    <br />
                    <div class="filte_action_btn linear-purple">
                        <button type="submit" name="filter_form">
                            اعمال فیلتر ها
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            function revertFilter() {
                document.querySelectorAll("revert").value = "";
                $(".start_date").val("");
                $(".end_date").val("");
        
                var ele = document.getElementsByName("projec_type");
                for (var i = 0; i < ele.length; i++)
                    ele[i].checked = false;
        
                const select = document.querySelector('#category');
                select.value = 'none'
            }
        </script>
        {{-- <script src="assets-new/js/range.js"></script> --}}
            </div>
    <div id="leftsidebar" class="col-sm-12 col-xl-8 col-md-8" style="padding: 16px;">
        <form action="">
            <div class="input-group search_box" style="margin: 0px;border: 1px solid #fff;border-radius: 8px;">
                <span class="input-group-text" type="submit" style="border: none;">
                    <img src="../../assets/img/inoje/icon/search.png" style="width: 30px;">
                </span>
                <input list="search_items_suggestion" id="fast_search" type="text" style="border: none;padding: 0px;color: white;
           background-color: #212529;color: white;" class="form-control" placeholder="عبارت جستجو را وارد کنید" name="search_param">
                <span class="search_btn linear-purple">
                    <button type="submit">
                        جستجو
                    </button>
                </span>

            </div>


            <datalist id="search_items_suggestion">
                {{-- @foreach ($search_res as $item)
                    <option value={{$item}}>{{$item}}</option>
               @endforeach --}}
            </datalist>
            <br />
            <br />
            <div id="mobile_box_filter">
                <div class="btn" data-toggle="modal" data-target="#filterModal">
                    فیلتر
                    <i class="fi fi-rr-sort-alt"></i>
                </div>
                <div class="btn">
                    <button class="taged_btn" type="submit" name="new" value="newest">
                        جدیدترین
                        <i class="fi fi-rr-sort-alt"></i>
                    </button>
                </div>
            </div>
            <div class="all_filter_item">
                <div class="row">
                    <div class="col-2 view_model">
                        <img src="../../assets/img/inoje/icon/card_view.png" alt="" onclick="card_view()">
                        <img src="../../assets/img/inoje/icon/list_view.png" alt="" onclick="list_view()">
                    </div>
                    <div class="col-10 filter_box" id="myBtnContainer">
                        <div class="btn">
                            <button class="taged_btn" type="submit" name="price" value="">
                                قیمت
                                <i class="fi fi-rr-sort-alt"></i>
                            </button>
                        </div>
                        <div class="btn">
                            <button class="taged_btn" type="submit" name="trend" value="">
                                ترند
                            </button>
                        </div>
                        <div class="btn">
                            <button class="taged_btn" type="submit" name="special" value="">
                                ویژه
                            </button>
                        </div>
                        <div class="btn">
                            <button class="taged_btn" type="submit" name="new" value="">
                                جدید ترین
                                <i class="fi fi-rr-sort-alt"></i>
                            </button>
                        </div>
                        <div class="btn">
                            <button class="taged_btn" type="submit" name="popular" value="">
                                محبوب ترین
                                <i class="fi fi-rr-sort-alt"></i>
                            </button>
                        </div>

                        <div class="btn">
                            <button class="taged_btn" type="submit" name="related" value="">
                                مرتبط ترین
                            </button>
                        </div>
                        <div class="btn active">
                            <button class="taged_btn" type="submit" name="all" value="">
                                همه
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <br />
        <div style="text-align: left;font-size: smaller;">5634 اینوژه یافت شد</div>
        <br />
        <div class="list_view_ctn">

            <div class="row">
                <section id="hero">
                    <div class="hero-slider-top d-flex justify-content-between">
                        <div class="hero-slider-toggle dir-ltr cursor-default">
                        </div>
                    </div>
                </section>
                @foreach ($projects as $project) 
                    <div class="col-12 list_view">
                        <div class="">
                            <div class="box p{{$project->id}} row" data-state="#about{{$project->id}}">
                                <div class="box-header col-sm-4 col-lg-4">
                                    <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none" 
                                    src="../../assets/img/inoje/articles/{{$project->img}}.jpg">

                                    <img class="box-avatar img-full pe-none"
                                     src="../../assets/img/inoje/users/200_1665259780Untitled-1.png" alt="avatar" />
                                    <span class="box-jobtitle">جواد
                                        داوری کیا</span>
                                    {{-- <a href="#">
                                        <h4 class="box-fullname line-clamp-1">طراحی بهینه یک پلتفرم ماهواره برای اهداف مخابراتی منظومه های ماهواره ای</h4>
                                    </a> --}}
                                </div>
                                <div class="box-main col-sm-8 col-lg-8">
                                    <div class="box-section is-active" id="about{{$project->id}}">
                                        <div class="box-content">
                                            <div class="box-subtitle">  {{$project->title}}</div>
                                            <p class="box-desc line-clamp-4">
                                                {{$project->about}} 
                                                                                       </p>
                                        </div>
                                    </div>
                                    <div class="box-section" id="timeline{{$project->id}}">
                                        <div class="box-content">
                                            <span class="box-subtitle">وضعیت پروژه:</span>
                                            <span class="box-item-desc">درحال اخذ</span>
                                            <div class="box-timeline">
                                                <div class="box-item" data-year="2014">
                                                    <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                                                    <div class="box-item-desc">05 مهر 1401</div>
                                                </div>
                                                <div class="box-item" data-year="2016">
                                                    <div class="box-item-title">مهلت ارسال پروپوزال</div>
                                                    <div class="box-item-desc">14 خرداد 1402</div>
                                                </div>
                                                <div class="box-item" data-year="2018">
                                                    <div class="box-item-title">مهلت داوری پروپوزال</div>
                                                    <div class="box-item-desc">29 خرداد 1402</div>
                                                </div>
                                                <div class="box-item" data-year="2020">
                                                    <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                                                    <div class="box-item-desc">30 خرداد 1402</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-section" id="contact{{$project->id}}">
                                        <div class="box-content">
                                            <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                                            <div class="box-contact-wrapper">
                                                <div class="box-contact">
                                                    مهندسی هوافضا
                                                </div>
                                                <button class="contact-me">ارسال پروپوزال</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-buttons">
                                        <button data-section="#about{{$project->id}}" data-p="{{$project->id}}" class="is-active">اطلاعات</button>
                                        <button data-section="#timeline{{$project->id}}" data-p="{{$project->id}}">زمانبندی</button>
                                        <button data-section="#contact{{$project->id}}" data-p="{{$project->id}}">پروپوزال</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="card_view" style="display: none;">
            <div class="row">
                @foreach ($projects as $project) 
                    <div class="col-sm-12 col-md-3 col-lg-4">
                        <div class="box p{{$project->id}}" data-state="#about{{$project->id}}">
                            <div class="box-header">
                                <img class="box-cover d-block w-100 h-100 position-absolute top-0 start-0 img-fit pe-none" 
                                src="../../assets/img/inoje/articles/{{$project->img}}.jpg">

                                <img class="box-avatar img-full pe-none" src="../../assets/img/inoje/users/200_1665259780Untitled-1.png" alt="avatar" />
                                <span class="box-jobtitle">جواد
                                    داوری کیا</span>
                                {{-- <a href="#">
                                    {{-- <h4 class="box-fullname line-clamp-1">   </h4> --}}
                                {{-- </a> --}} 
                                <div class="box-subtitle">  {{$project->title}}</div>
                            </div>
                            <div class="box-main">
                                <div class="box-section is-active" id="about{{$project->id}}">
                                    <div class="box-content">
                                        <p class="box-desc line-clamp-4">
                                            {{$project->about}}   
                                                                        
                                        </p>
                                    </div>
                                </div>
                                <div class="box-section" id="timeline{{$project->id}}">
                                    <div class="box-content">
                                        <span class="box-subtitle">وضعیت پروژه:</span>
                                        <span class="box-item-desc">درحال اخذ</span>
                                        <div class="box-timeline">
                                            <div class="box-item" data-year="2014">
                                                <div class="box-item-title">تاریخ بارگذاری در اینوا</div>
                                                <div class="box-item-desc">04 مهر 1401</div>
                                            </div>
                                            <div class="box-item" data-year="2016">
                                                <div class="box-item-title">مهلت ارسال پروپوزال</div>
                                                <div class="box-item-desc">14 خرداد 1402</div>
                                            </div>
                                            <div class="box-item" data-year="2018">
                                                <div class="box-item-title">مهلت داوری پروپوزال</div>
                                                <div class="box-item-desc">29 خرداد 1402</div>
                                            </div>
                                            <div class="box-item" data-year="2020">
                                                <div class="box-item-title">تاریخ اعلام نتایج داوری</div>
                                                <div class="box-item-desc">30 خرداد 1402</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-section" id="contact{{$project->id}}">
                                    <div class="box-content">
                                        <div class="box-subtitle">تخصص‌های مورد نیاز</div>
                                        <div class="box-contact-wrapper">
                                            <div class="box-contact">
                                                مهندسی کامپیوتر
                                            </div>
                                            <div class="box-contact">
                                                مهندسی برق
                                            </div>
                                            <div class="box-contact">
                                                مهندسی عمران
                                            </div>
                                            <button class="contact-me">ارسال پروپوزال</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-buttons">
                                    <button data-section="#about{{$project->id}}" data-p="{{$project->id}}" class="is-active">اطلاعات</button>
                                    <button data-section="#timeline{{$project->id}}" data-p="{{$project->id}}">زمانبندی</button>
                                    <button data-section="#contact{{$project->id}}" data-p="{{$project->id}}">پروپوزال</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('customScript')
<script>
    function card_view() {
        document.querySelector(".card_view").style.display = "block";
        document.querySelector(".list_view_ctn").style.display = "none";

    }

    function list_view() {
        document.querySelector(".card_view").style.display = "none";
        document.querySelector(".list_view_ctn").style.display = "block";
    }

    function darkLightTheme() {
        var element = document.getElementById("body");
        element.classList.toggle("light_theme_body");

        var element2 = document.getElementsByClassName("#myBtnContainer .btn");
        element2.classList.toggle("light_theme_cat");
    }
</script>

<script src="../../assets/js/inoje/datalist-css.min.js"></script>
<script src="../../assets/js/inoje/temp.js"></script>
@endsection
