<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checks';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'sms_id', 'status', 'user_id', 'from', 'check', 'cash'];

    public function user() {
        return $this->belongsTo(User::Class);
    }
    public function sms() {
        return $this->belongsTo(Sms::Class);
    }

}
