<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class monitoring extends Model
{
    public $guarded=['id'];
    protected $table='monitoring';
    protected  $fillable=['monitors_id','HTTP'];
}