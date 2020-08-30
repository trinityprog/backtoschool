<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = ['client_number','service_number', 'operator_name', 'submit_date', 'text', 'request_text', 'user_id'];
    public function user() {
        return $this->belongsTo(User::Class);
    }
    public function check() {
        return $this->hasOne(Check::Class);
    }
}
