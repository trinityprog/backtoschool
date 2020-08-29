<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'authorization']);

        if(!Cookie::has('locale')){
            Cookie::queue('locale', 'ru', time() + 60 * 60 * 24 * 30, null, null, false, false);
            App::setLocale('ru');
        }
        else{
            App::setLocale(Cookie::get('locale'));
        }
    }

    public function authorization(Request $request)
    {
        $data = $request->only('phone');
        $validator = Validator::make($data , [
            'phone' => 'required|size:16|exists:users,email',
        ]);
        if($validator->fails()){
            return redirect('/#authorization')
                ->withErrors($validator)->withInput();
        }
        $user = User::where('email', $data['phone'])->first();

        if($user){
            Auth::login($user);
            return redirect('/');
        }



        return redirect('/#authorization')->withErrors([ 'phone' => __('validation.exists', [ 'attribute' => 'телефон' ]) ]);
    }


}
