<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $guarded=['id'];
    protected $table='payment';
    protected  $fillable=['user_id','monitor_id','resnumber'];
}


/*function get_http_response_code($domain1) {
        $headers = get_headers($domain1);
        return substr($headers[0], 9, 3);
        }
        $domain1 = 'https://www.google.com/';
        $get_http_response_code = get_http_response_code($domain1);
        if ( $get_http_response_code == 200 ) {
            return "ok";
        } else {
            return "not ok";
        }*/