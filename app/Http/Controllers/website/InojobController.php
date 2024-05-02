<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Resources\activities\InojobResource;
use App\Http\Resources\activities\InojobSelectionRecource;
use App\Http\Resources\activities\InojobPriorities;
use App\Models\Inojob;
use App\Models\InojobCases;
use App\Models\InojobEmployer;
use App\Models\Score;
use App\Traits\activities\inojob\HttpInojob;
use Illuminate\Http\Request;

class InojobController extends Controller
{
    use HttpInojob;

    public function landing()
    {
        return view('inojob.landing');
    }

    public function index(Request $request)
    {
        // Get the filter criteria from the request
        $filters = $request->all();
        $filters = [
            'title' => $request->input('title'),
            'group' => $request->input('group'),
            'province' => $request->input('province'),
            'major' => explode(",", $request->input('major')),
            'type' => $request->input('type'),
            'min_salary' => $request->input('min_salary'),
            'max_salary' => $request->input('max_salary'),
            'gender' => $request->input('gender'),
            'degree' => $request->input('degree'),
            'facilities' => $request->input('facilities'), // Ensure it's an array
            // Add more filters here
        ];

        $inojobs = Inojob::filter($filters)->latest()->get(10);

        // Pass the results to your view
        return view('inojob.index', compact('inojobs'));
    }

    public function getInojobs(Request $req)
    {
        $filters = $req->all();
        $filters = [
            'title' => $req->has('title') ? $req->input('title') : null,
            'group' => $req->has('group') ? $req->input('group') : null,
            'province' => $req->has('province') ? $req->input('province') : null,
            'major' => $req->has('major') && strlen(substr($req->major, 1, -1)) > 1 ? explode(",", $req->input('major')) : null,
            'type' => $req->has('type') ? $req->input('type') : null,
            'min_salary' => $req->has('min_salary') ? $req->input('min_salary') : null,
            'max_salary' => $req->has('max_salary') ? $req->input('max_salary') : null,
            'gender' => $req->has('gender') ? $req->input('gender') : null,
            'degree' => $req->has('degree') ? $req->input('degree') : null,
            'employer' => $req->has('employer') ? $req->input('employer') : null,
            'facilities' => $req->has('facilities') ? $req->input('facilities') : null, // Ensure it's an array
            // Add more filters here
        ];
        // return Inojob::where('degree',$req['degree'])->get();

        $inojobs = Inojob::filter($filters)->latest()->paginate(10);
        // return [$inojobs->getBindings(), $inojobs->toSql()];
        return InojobResource::collection($inojobs);
    }

    function doIt()
    {
    }

    // public function getInojob($id)
    // {


    //     $inojob = Inojob::findOrFail($id);
    //     return response()->json(['inojob' => $inojob]);
    // }
    public function getInojobsFields(Request $req)
    {
        $inojobs = Inojob::all();
        $provinces = [];
        $majors = [];
        $degrees = [];
        $employers = [];
        $degreesA = [
            "bachelor" => "کارشناسی و بالاتر",
            "master" => "کارشناسی ارشد و بالاتر",
            "doctor" => "دکتری و بالاتر"
        ];
        foreach ($inojobs as $inojob) {
            $province = $inojob->location->province;
            $major = $inojob->major;
            $degree = $inojob->degree;
            $employer = $inojob->employer->name ?? null;
            foreach ($major as $m) {
                if (!in_array($m, $majors)) array_push($majors, $m);
            }
            if (!in_array($province, $provinces)) array_push($provinces, $province);
            if (!in_array($degree, $degrees)) array_push($degrees, $degree);
            if (!in_array($employer, $employers)) array_push($employers, $employer);
        }
        return $this->successHttpInojob([
            "provinces" => $provinces,
            "majors" => $majors,
            "degrees" => $degrees,
            "employers" => $employers
        ], "مقادیر فیلتر دریافت شد");
    }

    public function getInojob()
    {
        $names = [
            "وزارت نیرو" => "وزارت نیرو یکی از مهمترین وزارت خانه های اقتصادی دولت محسوب می شود. میزان اعتبارات سالیانه این وزارت خانه به طور طبیعی چند برابر برخی از وزارت خانه ها است. اهمیت تامین و توزیع آب و برق با کیفیت مطلوب که از حیاتی ترین نیازهای جامعه است، مهمترین هدف این وزارت خانه محسوب می شود.",
            "وزارت آموزش و پرورش" => "وزارت آموزش و پرورش ایران مسئولیت امور آموزشی کودکان و نوجوانان (معمولاً ۶ تا ۱۸ سالگی) و نیز تریبت معلم را عهده‌دار است.  این وزارت وظیفهٔ آموزش رایگان همهٔ افراد در مقاطع پیش دبستان، دبستان، دورهٔ اول متوسطه، دورهٔ دوم متوسطه و همچنین ادارهٔ دانشگاه فرهنگیان برای تربیت معلم و دانشگاه تربیت دبیر شهید رجایی را بر عهده دارد.",
            "سازمان ثبت اسناد و املاک کشور" => "سازمان ثبت اسناد و املاک کشور وظیفه ثبت و صدور سند تمامی املاک، معاملات، شرکت‌ها، اختراعات، علایم تجاری و دارایی‌های شخصی اتباع ایران را به عهده دارد. این سازمان با وظایف حقوقی و ساختار عملکرد مستقل، از نهادهای وابسته به قوه قضائیه جمهوری اسلامی ایران است. دفاتر اسناد رسمی و دفاتر ازدواج و طلاق تحت نظارت این سازمان قرار دارند.",
            "وزارت ارتباطات و فناوری اطلاعات" => "وزارت ارتباطات و فناوری اطلاعات مسئول برنامه‌ریزی، پشتیبانی و توسعه زیرساختار و توانایی‌های ملی مخابراتی و اطلاعاتی ایران است.",
            "وزارت امور اقتصاد و دارایی" => "تنظیم سیاستهای اقتصادی و مالی کشور و ایجاد هماهنگی در امور مالی و اجرای سیاستهای مالیاتی و تنظیم و اجرای برنامه همکاری‌های اقتصادی و سرمایه‌گذاری‌های مشترک با کشورهای خارجی، مهمترین هدف وزارت امور اقتصادی و دارایی می باشد.",
            "وزارت بهداشت، درمان و آموزش پزشکی" => "وزارت بهداشت، درمان و آموزش پزشکی در بدو تاسیس ۳ هدف عمده را سرلوحه عملکرد خود قرار داد؛ بهداشت، درمان و آموزش و پژوهش پزشکی. ماموریت اصلی این وزارتخانه، فراهم آوردن موجبات تأمین بهداشت و درمان کلیه افراد کشور از طریق تعمیم و گسترش خدمات بهداشتی، درمانی و آموزشی، است.",
            "وزارت جهاد کشاورزی" => "رسالت اصلی وزارت جهاد کشاورزی تامین امنیت غذایی مردم کشور است. در تامین امنیت غذایی ۴ محور اساسی حفظ منابع پایه ، مدیریت بر زمین ، آب و خاک ، مدیریت بر تولید و کشت، مدیریت بر منابع و نهاده ها، مدیریت بر بازار عرضه و مسائل اقتصادی تولید وجود دارد . در صورت حصول این چهار اصل را در کنار هم ، امنیت غذایی تامین خواهد شد.",
            "وزارت راه و شهرسازی" => "وزارت راه و شهرسازی متولی ادارهٔ امور حمل‌ونقل زمینی، دریایی و هوایی در محدودهٔ داخلی کشور و ارتباطات ترابری میان ایران و دیگر کشورهای جهان، همچنین سیاست‌گذاری در حوزه مسکن و شهرسازی در کشور می‌باشد.",
            "وزارت علوم، تحقیقات و فناوری" => "وزارت علوم، تحقیقات و فناوری مسئول انسجام بخشیدن به امور اجرایی، سیاست‌گذاری نظام دانشی، پژوهشی و فناوری ایران است. تمامی دانشگاه ها و موسسات آموزش عالی در ذیل این وزارتخانه فعالیت می کنند.",
            "وزارت فرهنگ و ارشاد اسلامی" => "وزارت فرهنگ و ارشاد اسلامی به عنوان یکی از اصلی‌ترین متولیان حوزه فرهنگ و هنر، وظیفه سیاست‌گذاری در زمینه‌های اطلاع‌رسانی و اشاعه فرهنگ اسلامی را برعهده دارد.",
            "وزارت کشور" => "وظیفه اصلی وزارت کشور، فراهم نمودن موجبات حفظ و امنیت در سراسر کشور و تأمین آزادی‌های سیاسی و اجتماعی در چارچوب قانون اساسی و سایر قوانین مملکتی و اجرای سیاست عمومی دولت به منظور پیشبرد برنامه‌های سیاسی، اجتماعی، اقتصادی و عمرانی و حفظ دستاوردهای انقلاب اسلامی می باشد.",
            "وزارت میراث فرهنگی، گردشگری و صنایع دستی" => "میراث فرهنگی هر کشور از اساسی‌ترین ارکان تحکیم هویت، ایجاد خلاقیت و خودباوری مل است. پژوهش در زمینه‌های مختلف آن موجب روشن شدن ابهامات تاریخی، شناخت ارزش‌های حاصل از میراث طولانی جامعه و تسریع در شناخت ارزش‌های نهفته در میراث فرهنگی هر کشور می‌شود. وزارت میراث فرهنگی، گردشگری و صنایع دستی وظیفهٔ ادارهٔ مسائل مربوط به آثار تاریخی و باستانی و نیز مدیریت گردشگری در کشور را برعهده دارد.",
            "سازمان زمین‌شناسی" => "سازمان زمین‌ شناسی و اکتشافات معدنی کشور مسئول انجام بررسیهای زمین‌شناسی و معدنی در سراسر کشور، جمع‌آوری نتایج فعالیتهای انجام شده در این زمینه، ایجاد هماهنگی، تهیه و انتشار نقشه‌های زمین شناسی ایران می‌باشد.",
            "سازمان ملی استاندارد" => "سازمان ملی استاندارد ایران تدوین‌کننده قوانین و قواعد مرتبط با استاندارد و اجراکننده و نظارت‌کننده بر آن‌ها می‌باشد.",
            "مرکز آمار ایران" => "مرکز آمار ایران وابسته به سازمان برنامه و بودجه می باشد. ماموریت اصلی این مرکز، مدیریت ­تهیه­ و انتشار آمارهای رسمی کشور و استقرار نظام آمارهای ثبتی‌مبنا با رعایت اصول بنیادین آمارهای رسمی است.",
            "سازمان نقشه‌برداری ایران" => "سازمان نقشه‌برداری کشور در حوزه امور زیربنایی و زیرساختی فعالیت دارد و زیرمجموعه سازمان برنامه و بودجه است و به‌عنوان عالی‌ترین نهاد حاکمیتی کشور در امور اطلاعات مکانی شناخته می‌شود، ریاست کمیته تخصصی نام‌نگاری و یکسان‌سازی نام‌های جغرافیایی کشوری در ایران نیز برعهده رئیس این سازمان است.",
            "مرکز ملی رقابت" => "شورای رقابت با هدف تسهیل فعالیت بخش خصوصی و به طور کلی‌تر عرصه اقتصادی و نوعی عامل برای کاهش ریسک در این بخش شکل گرفت تا بخش خصوصی با ورود به بازار نگران انحصارات و رقبای انحصارگر خود نباشد.",
            "وزارت دادگستری" => "قضاوت و دادرسی، که در روزگار قدیم به صورت ساده و ابتدایی و در قالب داوری خصوصی جریان داشت، امروز به صورتی پیچیده در آمده است و متناسب با درجه تمدن، نوع حکومت و مقتضیات سیاسی، اجتماعی و علمی جوامع، تغییر و تحول یافته است. به عبارت دیگر، پویایی، جزء لاینفک و اجتناب ناپذیر نظام قضایی است. وزارت دادگستری مسئولیت امور مربوط به روابط قوه قضاییه با قوه مجریه و قوه مقننه را برعهده دارد.",
            "معاونت حقوقی ریاست جمهوری" => "انجام امور حقوقی ریاست‌جمهوری و دولت و بررسی عضویت‌های دولت در سازمان‌ها و مجامع بین‌المللی، مستندسازی املاک دولت، هماهنگی و نظارت بر امور حقوقی دستگاه‌های اجرایی و رفع اختلاف آنها، اجرای برنامه تدوین و تنقیح قوانین و مقررات دولت الکترونیک، پیگیری اجرای قانون اساسی و حقوق شهروندی و انجام اطلاع‌رسانی پژوهش‌ها و آموزش‌های لازم در زمینه حقوقی از وظایف معاونت حقوقی ریاست جمهوری می‌باشد.",
            "سازمان برنامه و بودجه کشور" => "هدف اصلی سازمان برنامه و بودجه کشور، هماهنگ نمودن فعاليت‌هاي عمراني و لزوم تهيه برنامه‌هايي براي رشد اقتصادي و اجتماعي كشور می باشد.",
            "وزارت نفت" => "وزارت نفت وظیفه اعمال اصل مالکیت و حاکمیت ملی ایران بر ذخایر و منابع نفت و گاز، تفکیک وظایف حاکمیتی از تصدی در اداره و توسعه صنعت نفت و گاز کشور و تامین انرژی موردنیاز کشور را برعهده دارد.",
            "وزارت نفت",
            "وزارت دفاع و پشتیبانی نیروهای مسلح",
            "قوه قضائیه",
            "نهاد ریاست جمهوری",
            "سازمان انرژی اتمی ایران",
            "وزارت صنعت، معدن و تجارت",
            "وزارت ورزش و جوانان",
            "وزارت تعاون،کار و رفاه اجتماعی",
            "سازمان ملی استاندارد ایران",
            "سازمان اداری و استخدامی کشور"
        ];
        $index = 1;
        foreach ($names as $name => $des) {
            $inojobs = Inojob::where('emp->id', $index)->get();
            foreach ($inojobs as $inojob) {
                $inojob->update(["employer_id" => $index]);
            }
            InojobEmployer::create([
                "name" => $name,
                "status" => 1,
                "description" => $des,
                "count" => "{}",
                "image" => "/uploads/activities/injob/employers/{$index}.png"
            ]);
            $index++;
        }
    }


    public function show($id)
    {
        $inojob = Inojob::findOrFail($id);
        // $inojobs = Inojob::all();
        // foreach ($inojobs as $i){
        //     $employer = $i->degrees->doctora ? 'doctor' : ($i->degrees->master ? 'master' : 'bechelor');
        //     $i->update([
        //         "degree" => $degree
        //     ]);
        // }
        return view('inojob.show', compact('inojob'));
    }


    // public function getPriorities(Request $req)
    // {
    //     $selected = $req->user()->inojob->priorities;
    //     // return $selected;
    //     $inojobs = [];
    //     // $inojobs = Inojob::whereIn('id', $selected)->get();
    //     foreach ($selected as $i) {
    //         $inojob = Inojob::where('id', $i)->first();
    //         array_push($inojobs, $inojob);
    //     }
    // return $this->successHttpInojob(InojobResource::collection($inojobs), "اولویت ها دریافت شد", 200);
    //     // return $this->successHttpInojob(InojobSelectionRecource::collection($inojobSelections), "اولوی‍ت‌های شغلی دریافت شد", 200);
    // }
    // public function getPriority($id, Request $req)
    // {
    //     $userId = $req->user()->id;
    //     $inojobSelection = InojobSelections::whereId($id)->where('user_id', $userId)->first();
    //     if (is_null($inojobSelection)) return $this->errorHttpInojob([], "موقعیت شغلی وجود ندارد", 200);
    //     return $this->successHttpInojob(InojobSelectionRecource::collection($inojobSelection), "موقعیت شغلی دریافت شد", 200);
    // }
    // public function setPriority(Request $req)
    // {
    //     // *** WAYS TO GET USER :) TNX SANCTUM ***
    //     //1.$req->user(), auth('sanctum')->user(), Auth::user()
    //     // return "working";
    //     $req->user()->inojob->priorities = [1, 2, 3];
    //     $user = $req->user();
    //     $user_inojob = $user->inojob;
    //     $user_inojob->priorities = $req->priorities;
    //     $user->inojob = $user_inojob;
    //     $user->save();
    //     $selected = $req->user()->inojob->priorities;
    //     // $inojobs = [];
    //     // foreach ($selected as $i) {
    //     //     $inojob = Inojob::where('id', $i)->first();
    //     //     array_push($inojobs, $inojob);
    //     // }
    //     // return $this->successHttpInojob(InojobResource::collection($inojobs), "اولویت ها دریافت شد", 200);
    //     return $selected;
    // }
    public function getPriorities(Request $req)
    {
        $user = $req->user();
        $priorities = $user->inojob->priorities;
        $inojobs = [];

        foreach ($priorities as $priority => $status) {
            $inojob = Inojob::where('id', $priority)->first();
            $inojob['user_status'] = intval($status);  //add data inside Resource->Inojob
            $inojobs[] = $inojob;  //array_push($inojobs, $inojob)
        }
        return $this->successHttpInojob(InojobResource::collection($inojobs), "اولویت ها دریافت شد", 200);
    }

    public function setPriority(Request $req)
    {
        //$user = User::where('id', $id)->first();
        $user = $req->user();
        $user_inojob = $user->inojob;
        $priorities = $req->priorities;
        // $priorities = json_decode($priorities);  //convert str to arr

        if ($priorities !== null) {

            $user_inojob->priorities = [];  //get multi data object
            foreach ($priorities as $value) {
                $user_inojob->priorities[$value] = "0";
            }
        } else {
            return $this->errorHttpInojob([], 'مقدار الویت بندی های کاربر خالی می باشد', 404);
        }

        $user->inojob = $user_inojob;
        $user->save();
        $selected = $user->inojob->priorities;
        $inojobs = [];
        return $selected;
    }

    public function getPrioritiesStatus(Request $req)
    {
        $status = $req->user()->inojob->priority_status;
        return $status;
    }

    public function getUserCase(Request $req)
    {
        $case = InojobCases::where('user_id', $req->user()->id)->first();
        if ($case) return $case;
        return null;
    }

    public function deleteUserCase(Request $req)
    {
        $userId = $req->user()->id;
        $case = InojobCases::where('user_id', $userId)->first();
        $res = $case->delete();
        $possible_status = [3, 5, 1];
        Score::whereUserId($userId)->whereIn('status', $possible_status)->update(['status' => 0]);
        $user_inojob = $req->user()->inojob;
        $user_inojob->personal_status = 0;
        $user_inojob->priority_status = 0;

        $req->user()->update([
            "inojob" => $user_inojob
        ]);
        return $res;
    }
}
