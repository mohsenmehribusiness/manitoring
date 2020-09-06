<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class monitor extends Model
{
    public $guarded=['id'];
    protected $table='monitors';
    protected  $fillable=['name','URL','user_id','time','day'];
}
