@extends('layouts')

@section('content')
<div class="container">
    <h1>جزئیات شغل Inojob</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $inojob->title }}</h5>
            
            <ul>
                <li><strong>شناسه:</strong> {{ $inojob->id }}</li>
                <li><strong>شناسه گروه:</strong> {{ $inojob->group_id }}</li>
                <li><strong>شناسه کارفرما:</strong> {{ $inojob->employer->id }}</li>
                <li><strong>نام کارفرما:</strong> {{ $inojob->employer->name }}</li>
                <li><strong>وضعیت:</strong> {{ $inojob->status }}</li>
                <li><strong>توضیحات:</strong> {{ $inojob->description }}</li>
                <li><strong>تصویر:</strong> {{ $inojob->image }}</li>
                <li><strong>مکان - استان:</strong> {{ $inojob->location->province }}</li>
                <li><strong>مکان - نقطه:</strong> {{ $inojob->location->spot }}</li>
                <li><strong>ویژگی‌ها - نوع:</strong> {{ $inojob->properties->type }}</li>
                <li><strong>ویژگی‌ها - سایت:</strong> {{ $inojob->properties->site }}</li>
                <li><strong>ویژگی‌ها - حقوق:</strong> {{ $inojob->properties->salary }}</li>
                <li><strong>ویژگی‌ها - جنسیت:</strong> {{ $inojob->properties->gender }}</li>
                <li><strong>ویژگی‌ها - سن:</strong> {{ $inojob->properties->age }}</li>
                <li><strong>پین:</strong> {{ $inojob->pin }}</li>
                <li><strong>رشته‌ها:</strong> {{ implode(', ', $inojob->major) }}</li>
                <li><strong>تاریخ - تاریخ انتشار:</strong> {{ $inojob->date->publishDate }}</li>
                <li><strong>تاریخ - تاریخ انقضا:</strong> {{ $inojob->date->endDate }}</li>
                <li><strong>تعداد - درخواست‌ها:</strong> {{ $inojob->count->requests }}</li>
                <li><strong>تعداد - بازدیدها:</strong> {{ implode(', ', $inojob->count->views) }}</li>
                <li><strong>تعداد - پسندیدن‌ها:</strong> {{ implode(', ', $inojob->count->likes) }}</li>
                <li><strong>امکانات:</strong> {{ implode(', ', $inojob->facilities) }}</li>
                <li><strong>مدارک - کارشناسی:</strong> {{implode(',', $inojob->degrees) }}</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('inojob-index') }}" class="btn btn-primary mt-3">بازگشت به لیست شغل‌ها</a>
</div>
@endsection
