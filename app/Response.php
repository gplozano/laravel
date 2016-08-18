<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Response extends Model
{
    //

    protected $table = "canned_responses";
    
    protected $fillable = [
    	'order',
    	'title',
    	'content'
    ];

    
}
