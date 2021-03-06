<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'winners';

    protected $dates = ['date_win'];
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
    protected $fillable = ['name', 'phone', 'city', 'prize', 'from', 'date_win'];


}
