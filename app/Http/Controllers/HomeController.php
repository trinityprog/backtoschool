<?php

namespace App\Http\Controllers;

use App\Mail\QuestionCreated;
use App\Question;
use App\Winner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {

    }



    public function index()
    {
        if(Carbon::parse('2020-09-01 00:01:00')->isPast() || Str::contains(''.URL::current(), 'test') == true){
            return view('pages.index');
        }else{
            echo "XD";
        }
    }






//    public function profile(){
//        return view('pages.profile');
//    }



    public function question (Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:20|alpha',
            'email' => 'required|email:rfc',
            'phone' => 'required|size:16',
            'question' => 'required|min:10|max:150'
        ],[
            'name.required' => 'Անհրաժեշտ է լրացնել անունը',
            'name.min' => 'Անհրաժեշտ է լրացնել անունը',
            'name.alpha' => 'Անհրաժեշտ է լրացնել անունը',
            'name.max' => 'Անհրաժեշտ է լրացնել անունը',
            'phone.required' => 'Անհրաժեշտ է լրացնել հեռախոսահամարը',
            'email.required' => 'Անհրաժեշտ է լրացնել e-mail-ը',
            'email.email' => 'Անհրաժեշտ է լրացնել e-mail-ը'
        ]);

        if($validator->fails())
            return redirect('/#faq')->withInput($data)->withErrors($validator);
//            return redirect('/#faq')->withInput($data);

        $question = Question::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'question' => $data['question']
        ]);

        Mail::to('support@backtoschool.am')->send(new QuestionCreated($question));

        return redirect('/#faq-success');
    }

    public function winners (Request $request){
        if(!empty($request->get('phone'))){
            $phone = trim($request->get('phone'), '_');
            return Winner::where([
                ['phone', 'LIKE', $phone . '%'],
            ])->latest()->get();
        }

        return Winner::all();
    }



}
