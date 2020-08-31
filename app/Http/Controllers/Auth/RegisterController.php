<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/admin";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('registration');

        if(!Cookie::has('locale')){
            Cookie::queue('locale', 'ru', time() + 60 * 60 * 24 * 30, null, null, false, false);
            App::setLocale('ru');
        }
        else{
            App::setLocale(Cookie::get('locale'));
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registration(Request $request){
        $data = $request->only(['name', 'phone', 'rules']);


        $validator = Validator::make($data , [
            'name' => 'required|min:2|max:20|alpha',
            'phone' => 'required|size:16|unique:users,email',
            'rules' => 'required',
        ],[
            'name.required' => 'Անհրաժեշտ է լրացնել անունը',
            'name.min' => 'Անհրաժեշտ է լրացնել անունը',
            'phone.required' => 'Անհրաժեշտ է լրացնել հեռախոսահամարը',
        ]);

        if($validator->fails()){
            return redirect('/#registration')
                ->withErrors($validator)
                ->withInput();
//            return redirect('/#registration')
//                ->withErrors($validator)->withInput();
        }
        $data = $validator->validated();

//        $user = null;
//        if(User::where('email', $data['phone'])->exists()){
//            $user = User::where('email', $data['phone'])->first();
//            if(!$user->hasPermission($data['type'])){
//                $user->type .= ',' . $data['type'];
//                $user->save();
//            }
//        }
//        else{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['phone'],
                'password' => Hash::make('password'),
//                'type' => 'user:' . $data['type']
            ]);
//        }




        Auth::login($user);

        return redirect('/');
    }
}
