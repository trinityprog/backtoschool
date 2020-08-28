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
    }



    public function index()
    {
        return view('pages.index');
    }






    public function profile(){
        return view('pages.profile');
    }



    public function question (Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:20|alpha',
            'email' => 'required|email:rfc',
            'phone' => 'required|size:16',
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

        Mail::to('dentechduke@gmail.com')->send(new QuestionCreated($question));

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
