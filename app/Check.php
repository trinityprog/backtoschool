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
    protected $fillable = ['photo', 'status', 'user_id', 'type', 'code', 'cash'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
