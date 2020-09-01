<?php

namespace App\Http\Controllers;

use App\Check;
use App\Sms;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SMSController extends Controller
{
    public function index (Request $request)
    {
        $text_split = explode (' ', $request->text );

        if( count ( $text_split ) == 2 ) {

            $client_number = "+"
            .substr($request->msisdn, 0, 3)." "
            .substr($request->msisdn, 3, 2)." "
            .substr($request->msisdn, 5, 2)." "
            .substr($request->msisdn, 7, 2)." "
            .substr($request->msisdn, 9, 2);

        $user = User::select('id', 'email')->where('email', $client_number)->first();
        if(!$user){
            $user = User::create([
                'email' => $client_number,
                'password' => Str::random(12),
                'from' => 'sms'
            ]);
            $user_id = $user->id;
        } else
            $user_id = $user->id;
        if($request->has(['service-number', 'operator', 'date'])) {

            $sms = Sms::create([
                'client_number' => $request->msisdn ? $request->msisdn : " - ",
                'service_number' => request('service-number') ? request('service-number') : " - ",
                'operator_name' => $request->operator ? $request->operator : " - ",
                'submit_date' => $request->date ? $request->date : " - ",
                'text' => $request->text ? $request->text : " - ",
                'request_text' => json_encode($request->all()),
                'user_id' => $user_id,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]);

        } else {

            $sms = Sms::create([
                'client_number' => $request->msisdn ? $request->msisdn : " - ",
                'text' => $request->text ? $request->text : " - ",
                'request_text' => json_encode($request->all()),
                'user_id' => $user_id,
                'status' => 1,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]);

        }

        Check::create([
            'check' => $text_split[0],
            'cash' => $text_split[1],
            'from' => 'sms',
            'user_id' => $user_id,
            'sms_id' => $sms->id

            ]);

        } else {
            $sms = Sms::create([
                'client_number' => $request->msisdn ? $request->msisdn : " - ",
                'text' => $request->text ? $request->text : " - ",
                'request_text' => json_encode($request->all()),
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]);
            return "Սխալ տվյալներ: Մուտքագրիր կտրոնի Ֆիսկալ համարը<բացատ>Դրամարկղի համարը";
        }
        return "Կտրոնն ընդունված է և ստուգումից հետո կմասնակցի շաբաթական խաղարկությանը";
    }
}
//{"msisdn":"37498339075","service-number":"1004","operator":"Vivacell","text":"12345678 1234","id":"40262108","date":"2020-08-28%2011%3A45%3A00"}msisdn=+37499999999&servicenumber=1234&operator=operator&text=Test%20Message&date=2008-10-13%2013:30:10

//msisdn=37498339075&service-number=1004&operator=Vivacell&text=12345678%201234&id=40262108&date=2020-08-28%2011%3A45%3A00
