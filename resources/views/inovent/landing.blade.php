@extends('layouts2')
@section('mainCon')
<form>
<header class="text-center flex-column inovent-header d-flex justify-content-center p-2">
    <h1 class="text-ex-bold text-center py-lg-5 fs-5 mb-3">
        مهم ترین رویداد های اینوایی در این بخش آورده شده است
        </h1>
    <div id="inoventSearch" class="mx-auto mt-5 d-flex filter-box flex-column flex-sm-row rounded-5 col-12 col-lg-9 col-xl-8 col-xxl-6 dir-rtl">
        <div class="d-flex col search-inovent-box rounded-sm-pill rounded-5 rounded-sm-0">
            <div class="p-3 cursor-pointer" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img src="/assets/img/inovent_filter.svg" class="pe-3"> 
            </div>
            <input type="text" name="search" value="{{ Request::get('search') }}" class="col border-none outline-none p-1 bg-none" placeholder="عنوان رویداد مورد نظر را جست و جو کنید ...">
        </div>
        <button type="submit" class="text-white px-4 btn btn-blue p-3 rounded-5 mt-3 mt-sm-0">جست و جو</button>
        
        
    </div>
</header>
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content dir-rtl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            فیلتر جستجو
                        </h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="w-100">
                            <!-- <tr>
                                </td>
                                <td class="d-sm-table-cell d-block py-2" colspan="2">
                                    <div class="custom-select mw-100"><input type="text" name="search" placeholder="عنوان رویداد"
                                            class="select-selected w-100" value="{{ Request::get('search') }}"></div>
                                </td>
                            </tr> -->
                            <tr>
                                <td class="d-sm-table-cell d-block py-2">
                                    <div class="custom-select mw-100">
                                        <select name="status" id="status" class="form-control">
                                            <option {{ Request::get('status') == 'all' ? 'selected' : '' }} value="all">
                                                همه رویدادها
                                            </option>
                                            <option {{ Request::get('status') == 'not_started' ? 'selected' : '' }}
                                                value="not_started">
                                                شروع نشده
                                            </option>
                                            <option {{ Request::get('status') == 'in_progress' ? 'selected' : '' }}
                                                value="in_progress">
                                                در حال برگزاری
                                            </option>
                                            <option {{ Request::get('status') == 'done' ? 'selected' : '' }} value="done">
                                                به اتمام رسیده
                                            </option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-sm-table-cell d-block py-2">
                                    <div class="custom-select mw-100">
                                        <select name="sort" id="sort" class="form-control">
                                            <option {{ Request::get('sort') == 'newest' ? 'selected' : '' }} value="newest">
                                                جدیدترین
                                            </option>
                                            <option {{ Request::get('sort') == 'soon' ? 'selected' : '' }} value="soon">
                                                نزدیک ترین
                                            </option>
                                            <option {{ Request::get('sort') == 'oldest' ? 'selected' : '' }} value="oldest">
                                                قدیمی ترین
                                            </option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-sm-table-cell d-block py-2">
                                    <div class="custom-select select-lg mw-100">
                                        <select name="type" class="form-control" id="type">
                                            <option value="all" {{Request::get('type') ? '' : 'selected'}}>همه انواع</option>
                                            @foreach ($sArr['sTypes'] as $p)
                                                @if($p != '')
                                                    <option {{ Request::get('type') == $p ? 'selected' : '' }}
                                                        value="{{ $p }}">
                                                        {{ $p }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-sm-table-cell d-block py-2">
                                    <div class="custom-select select-lg mw-100">
                                        <select name="category" class="form-control" id="category">
                                            <option value="all" {{Request::get('category') ? '' : 'selected'}}>همه موضوعات</option>
                                            @foreach ($sArr['sCats'] as $p)
                                                @if($p != '')
                                                    <option {{ Request::get('category') == $p ? 'selected' : '' }}
                                                        value="{{ $p }}">
                                                        {{ $p }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!--<tr>-->
                            <!--    </td>-->
                            <!--    <td class="d-sm-table-cell d-block py-2">-->
                            <!--        <div class="custom-select mw-100">-->
                            <!--            <input type="text" class="select-selected form-control" id="fromDate"-->
                            <!--                value="{{ trim(Request::get('from')) != null ? date('Y-m-d H:i:s', Request::get('from') / 1000) : date('Y-m-d H:i:s', $dateRelated['from']) }}">-->
                            <!--            <input type="hidden" name="from" id="fromDate_alt">-->
                            <!--        </div>-->
                            <!--    </td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    </td>-->
                            <!--    <td class="d-sm-table-cell d-block py-2">-->
                            <!--        <div class="custom-select mw-100">-->
                            <!--            <input type="text" class="select-selected form-control" id="toDate"-->
                            <!--                value="{{ trim(Request::get('to')) != null ? date('Y-m-d H:i:s', Request::get('to') / 1000) : date('Y-m-d H:i:s', $dateRelated['to']) }}">-->
                            <!--            <input type="hidden" name="to" id="toDate_alt">-->
                            <!--        </div>-->
                            <!--    </td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td colspan="2" class="text-center py-2">-->
                            <!--        <label for="checkForMe" class="text-warning">پیشنهاد به من</label>-->
                            <!--        <input name="suggest" class="form-check-input" type="checkbox" value="1"-->
                            <!--            id="checkForMe">-->
                            <!--        <label for="checkForMe" class="checkForMe"></label>-->
                            <!--    </td>-->
                            <!--</tr>-->
                            <tr>
                                <td colspan="2" class="text-center py-2">
                                    <div class="d-flex ">
                                        <button  class="btn w-100 btn-blue rounded-4 px-3" type="submit">
                                            <span class="fs-7 text-ex-bold text-white">اعمال فیلتر</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
<main>
    <div class="mx-auto my-5 row col-lg-11 dir-rtl align-itemns-stretch">
        @if(count($inovents) > 0)
            @if($inovents[0]->id == 9)
                <div class="col-xl-4 col-sm-6 col-12 mb-4">
                        <div class="text-decoration-none inovent-box rounded-4 overflow-hidden h-100 position-relative">
                            <div class="position-absolute top-0 start-0 bg-danger text-white inovent-new px-3 py-1">جدید</div>
                            <img src="{{$inovents[0]->image}}" alt="{{$inovents[0]->title}}" class="w-100 r-4-3">
                            <div class="p-3 mt-1">
                                <a href="{{route('inovent' , $inovents[0]->id)}}" class="fs-6 text-ex-bold text-white text-decoration-none mb-4">{{$inovents[0]->title}}</a>
                                <!--<p class="fs-7 mt-3">-->
                                <!--    <span>محل برگزاری: </span>-->
                                <!--    <span>{{$inovents[0]->place}}</span>-->
                                <!--</p>-->
                                <!--<p class="text-muted fs-8">-->
                                <!--    <span class="text-muted">تاریخ برگزاری: </span>-->
                                <!--    <span class="text-muted">{{jdate($inovents[0]->date)->format('%d %B %Y')}}</span>-->
                                <!--    <span class="text-muted">، ساعت</span>-->
                                <!--    <span class="text-muted">{{jdate($inovents[0]->date)->format('H:m')}}</span>-->
                                <!--</p>-->
                                <p class="fs-7 mt-3">
                                    مدت زمان این همایش دو روز بوده و از جمله برنامه های آن دیدار با مقام معظم رهبری و دیدار با رئیس جمهور می باشد. با توجه به محدودیت تعداد نفرات شرکت کننده در این دیدار ثبت نام اولیه صورت می پذیرد و در مرحله بعد تعدادی از نخبگان برای شرکت انتخاب می شوند.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center w-fit">
                                        <img src="/assets/img/major-icon.svg" alt="major icon"  class="w-20 me-1">
                                        <span class="text-ex-bold text-gray fs-7">رشته: تمامی رشته ها</span>
                                    </div>
                                    <div class="d-flex align-items-center w-fit">
                                        <img src="/assets/img/calender-icon.svg" alt="calender icon"  class="w-20 me-1">
                                        <span class="text-ex-bold text-gray fs-7">زمان برگزاری: هفته چهارم مهر</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @foreach($inovents->slice(1,8) as $i)
                    <div class="col-xl-4 col-sm-6 col-12 mb-4">
                        <div class="text-decoration-none inovent-box rounded-4 overflow-hidden h-100 position-relative">
                            
                            <img src="{{$i->image}}" alt="{{$i->title}}" class="w-100 r-4-3">
                            <div class="p-3 mt-2">
                                <a target="_blank" href="{{$i->link}}" class="fs-6 text-ex-bold text-white text-decoration-none">{{$i->title}}</a>
                                <p class="fs-7 mt-3">
                                    <span>محل برگزاری: </span>
                                    <span>{{$i->place}}</span>
                                </p>
                                
                                    @switch($i->id)
                                        @case(7)
                                            <span class="fs-7-5 mb-3 text-muted">آشنایی با اکوسیستم نوآوری و استارتاپی امروز ایران.</span>
                                            @break
                                        @case(6)
                                            <span class="fs-7-5 mb-3 text-muted">دورهمی دانشجویان CS50xTehran</span>
                                            @break
                                        @case(4)
                                            <span class="fs-7-5 mb-3 text-muted">تهران اوین، دانشگاه شهید بهشتی، دانشکده برق و کامپیوتر</span>
                                            @break
                                        @case(3)
                                            <span class="fs-7-5 mb-3 text-muted">نمایشگاه اربعین</span>
                                            @break
                                        @case(1)
                                            <span class="fs-7-5 mb-3 text-muted">همراه با بیان تجربه های عینی توسط مدیران شرکت ها </span>
                                            @break
                                    @endswitch
                                <p class="text-muted fs-7-5 mt-2">
                                    <span class="text-muted">تاریخ برگزاری: </span>
                                    <span class="text-muted">{{jdate($i->date)->format('%d %B %Y')}}</span>
                                    <span class="text-muted">، ساعت</span>
                                    <span class="text-muted">{{jdate($i->date)->format('H:m')}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @else
                @foreach($inovents as $i)
                    <div class="col-xl-4 col-sm-6 col-12 mb-4">
                        <div class="text-decoration-none inovent-box rounded-4 overflow-hidden h-100 position-relative">
                            
                            <img src="{{$i->image}}" alt="{{$i->title}}" class="w-100 r-4-3">
                            <div class="p-3 mt-2">
                                <a target="_blank" href="{{$i->link}}" class="fs-6 text-ex-bold text-white text-decoration-none">{{$i->title}}</a>
                                <p class="fs-7 mt-3">
                                    <span>محل برگزاری: </span>
                                    <span>{{$i->place}}</span>
                                </p>
                                
                                    @switch($i->id)
                                        @case(7)
                                            <span class="fs-7-5 mb-3 text-muted">آشنایی با اکوسیستم نوآوری و استارتاپی امروز ایران.</span>
                                            @break
                                        @case(6)
                                            <span class="fs-7-5 mb-3 text-muted">دورهمی دانشجویان CS50xTehran</span>
                                            @break
                                        @case(4)
                                            <span class="fs-7-5 mb-3 text-muted">تهران اوین، دانشگاه شهید بهشتی، دانشکده برق و کامپیوتر</span>
                                            @break
                                        @case(3)
                                            <span class="fs-7-5 mb-3 text-muted">نمایشگاه اربعین</span>
                                            @break
                                        @case(1)
                                            <span class="fs-7-5 mb-3 text-muted">همراه با بیان تجربه های عینی توسط مدیران شرکت ها </span>
                                            @break
                                    @endswitch
                                <p class="text-muted fs-7-5 mt-2">
                                    <span class="text-muted">تاریخ برگزاری: </span>
                                    <span class="text-muted">{{jdate($i->date)->format('%d %B %Y')}}</span>
                                    <span class="text-muted">، ساعت</span>
                                    <span class="text-muted">{{jdate($i->date)->format('H:m')}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @else
            <p>نتیجه ای یافت نشد</p>
        @endif
</main>
@endsection
@section('customScript')
<script>
    var inoventSearch = document.getElementById('inoventSearch');
    function submitForm(){
        inoventSearch.submit();
    }
    const datePickerConfig1 = {
            "inline": false,
            "format": "YYYY/MM/DD H:mm:ss",
            "viewMode": "day",
            "initialValue": true,
            "minDate": <?= $dateRelated['from'] * 1000 ?>,
            "maxDate": <?= $dateRelated['to'] * 1000 ?>,
            "autoClose": true,
            "position": "auto",
            "altFormat": "unix",
            "observer": true,
            "altField": "#fromDate_alt",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "inputDelay": 800,
            "observer": true,
            "calendar": {
                "persian": {
                    "locale": "fa",
                    "showHint": true,
                    "leapYearMode": "astronomical"
                },
                "gregorian": {
                    "locale": "en",
                    "showHint": false
                }
            },
            "navigator": {
                "enabled": true,
                "scroll": {
                    "enabled": true
                },
                "text": {
                    "btnNextText": "<",
                    "btnPrevText": ">"
                }
            },
            "toolbox": {
                "enabled": true,
                "calendarSwitch": {
                    "enabled": false,
                    "format": "MMMM"
                },
                "todayButton": {
                    "enabled": true,
                    "text": {
                        "fa": "امروز",
                        "en": "Today"
                    }
                },
                "submitButton": {
                    "enabled": true,
                    "text": {
                        "fa": "تایید",
                        "en": "Submit"
                    }
                },
                "text": {
                    "btnToday": "امروز"
                }
            },
            "timePicker": {
                "enabled": true,
                "step": 1,
                "hour": {
                    "enabled": true,
                    "step": null
                },
                "minute": {
                    "enabled": true,
                    "step": null
                },
                "second": {
                    "enabled": true,
                    "step": null
                },
                "meridian": {
                    "enabled": false
                }
            },
            "dayPicker": {
                "enabled": true,
                "titleFormat": "YYYY MMMM"
            },
            "monthPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "yearPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "responsive": true
        };
        const datePickerConfig2 = {
            "inline": false,
            "format": "YYYY/MM/DD H:mm:ss",
            "viewMode": "day",
            "initialValue": true,
            "minDate": <?= $dateRelated['from'] * 1000 ?>,
            "maxDate": <?= $dateRelated['to'] * 1000 ?>,
            "autoClose": true,
            "position": "auto",
            "altFormat": "unix",
            "observer": true,
            "altField": "#toDate_alt",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "inputDelay": 800,
            "observer": true,
            "calendar": {
                "persian": {
                    "locale": "fa",
                    "showHint": true,
                    "leapYearMode": "astronomical"
                },
                "gregorian": {
                    "locale": "en",
                    "showHint": false
                }
            },
            "navigator": {
                "enabled": true,
                "scroll": {
                    "enabled": true
                },
                "text": {
                    "btnNextText": "<",
                    "btnPrevText": ">"
                }
            },
            "toolbox": {
                "enabled": true,
                "calendarSwitch": {
                    "enabled": false,
                    "format": "MMMM"
                },
                "todayButton": {
                    "enabled": true,
                    "text": {
                        "fa": "امروز",
                        "en": "Today"
                    }
                },
                "submitButton": {
                    "enabled": true,
                    "text": {
                        "fa": "تایید",
                        "en": "Submit"
                    }
                },
                "text": {
                    "btnToday": "امروز"
                }
            },
            "timePicker": {
                "enabled": true,
                "step": 1,
                "hour": {
                    "enabled": true,
                    "step": null
                },
                "minute": {
                    "enabled": true,
                    "step": null
                },
                "second": {
                    "enabled": true,
                    "step": null
                },
                "meridian": {
                    "enabled": false
                }
            },
            "dayPicker": {
                "enabled": true,
                "titleFormat": "YYYY MMMM"
            },
            "monthPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "yearPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "responsive": true
        };
        $('#fromDate').persianDatepicker(datePickerConfig1);
        $('#toDate').persianDatepicker(datePickerConfig2);
    try {
        makeSlider(".slide-wrapper1");
    } catch {
        console.log('no table');
    }
</script>
@endsection

