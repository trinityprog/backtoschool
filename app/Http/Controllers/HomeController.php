<?php

namespace App\Http\Controllers;

use App\Mail\QuestionCreated;
use App\Question;
use App\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {
//        if(!Cookie::has('locale')){
//            Cookie::queue('locale', 'ru', time() + 60 * 60 * 24 * 30, null, null, false, false);
//            App::setLocale('ru');
//        }
//        else{
//            App::setLocale(Cookie::get('locale'));
//        }
    }

    public function stores (){
        return view('pages.stores');
    }

    public function index()
    {
        return view('pages.index');
    }

//    public function store($type)
//    {
//        return view('pages.' . $type, compact('type'));
//    }




    public function profile(){
//        $type = 'magnum';
        return view('pages.profile');
    }

//    public function language ($locale) {
//        App::setLocale($locale);
//        Cookie::queue('locale', $locale, time() + 60 * 60 * 24 * 30, null, null, false, false);
//
//        return redirect()->back();
//    }

    public function question (Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:20|alpha',
            'email' => 'required|email:rfc',
            'phone' => 'required|size:14',
            'question' => 'required|min:10|max:150'
        ]);

        if($validator->fails())
            return back()->withInput($data)->withErrors($validator);

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
