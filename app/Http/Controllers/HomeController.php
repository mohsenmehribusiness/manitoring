<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
Use DB;
use App\Monitor;
use App\Payment;
use SoapClient;
use App\monitoring;
use Illuminate\Support\Facades\Session;

use App\lib\Bit;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index()
    {
        return View('admin.index');
    }

    public function check(Request $request)
    {
        return "hello";
    }

    public function monitoring(Request $request)
    {
        $monitoring=monitoring::where('monitors_id',$request->id)->get();
        return $monitoring;
    }

    public function delete(Request $request)
    {
        $monitoring=monitoring::where('monitors_id',$request->id);
        $monitor=monitor::findOrFail($request->id);
        $monitor->delete();
        $monitoring->delete();
        alert()->success('با موفقیت حذف شد', 'حذف شد!');
        return redirect()->back();
    }

    public  function showmonitor($id)
    {
        $list_of_http_status_codes=array();
        $list_of_http_status_codes=["100"=>"ادامه ارسال","101"=>"تعویض پروتکل ها","102"=>"در حال پردازش","200"=>"پاسخ موفق","201"=>"ساخته شده","202"=>"موافقت شده","203"=>"اطلاعات غیر معتبر",
            "204"=>"پاسخ بدون محتوا","205"=>"بازنشانی محتوا","206"=>"محتوای جزئی","300"=>"انتخاب چندگانه","301"=>"انتقال همیشگی","302"=>"پیدا شد","303"=>"دیدن منبعی دیگر","304"=>"بدون تغییر","305"=>"استفاده از پروکسی","306"=>"تعویض پروکسی","307"=>"انتقال موقت",
            "500"=>"خطای داخلی سرور","501"=>"غیر مجهز یا تکمیل نشده","502"=>"خطای دروازه میانجی","503"=>"سرویس خارج از دسترس","504"=>"پایان حداکثر زمان دروازه میانجی","505"=>"نسخه HTTP پشتیبانی نمی شود",
            "400"=>"درخواست بد","401"=>"دسترسی نا معتبر","402"=>"نیاز به پرداخت","403"=>"دسترسی غیر مجاز","404"=>"منبع درخواستی پیدا نشد",
            "405"=>"متد غیر مجاز","406"=>"غیر قابل قبول","407"=>"نیاز به مجوز پروکسی","408"=>"پایان حداکثر زمان درخواست","409"=>"تعارض",
            "410"=>"محذوف","411"=>"عدم ارسال طول درخواست","412"=>"پیش شرط رد شده"];
            //$search=array_get($list_of_http_status_codes, 200);
        $monitors=monitor::where('user_id',auth()->user()->id)->get();
        return view('admin.monitors',compact('monitors','list_of_http_status_codes'));
    }

    public function monitor(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'URL' => 'required',
            'time' => 'required'
        ]);
        if($request->day<6)
        {
            $monitors = new monitor($request->all());
            $monitors->save();
            alert()->success('ثبت با موفقیت انجام شد', 'ثبت شد');
            return redirect()->route('showmonitor',['id'=>auth()->user()->id]);
        }
        else if($request->day>6)
        {
            $url = 'http://bitpay.ir/payment-test/gateway-send';
            $api = 'adxcv-zzadq-polkjsad-opp13opoz-1sdf455aadzmck1244567';
            $amount = 1000;
            $redirect = 'http://localhost:8000/user/buyback';
            $name = auth()->user()->name;
            $email = auth()->user()->email;
            $description = 'test_content';
            $factorId = auth()->user()->id;
            $result = Bit::send($url,$api,$amount,$redirect,$factorId,$name,$email,$description);
            if($result > 0 && is_numeric($result))
            {
                $monitors = new monitor($request->all());
                $monitors->save();
                return redirect('http://bitpay.ir/payment-test/gateway-'.$result);
            }
        }
    }

    public function buyback(Request $request)
    {
        $url = 'http://bitpay.ir/payment-test/gateway-result-second';
        $api = 'adxcv-zzadq-polkjsad-opp13opoz-1sdf455aadzmck1244567';
        $trans_id = $request->trans_id;
        $id_get = $request->id_get;
        $result = Bit::get($url,$api,$trans_id,$id_get);
        if($result == 1)
        {
            alert()->success('پرداخت با موفقیت انجام، و اطلاعات ثبت شد', 'پرداخت شد');
            return redirect()->route('showmonitor',['id'=>auth()->user()->id]);
        }
        else
        {
            return $result;
        }
    }

    public  function redirectt()
    {
        return redirect()->route('home');
    }
}


