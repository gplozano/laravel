<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Note extends Model
{
    //
    protected $fillable = [
    	'issue_id',
    	'note',
    	'created_date',
        'user_id'
    ];

    protected $dates = ['created_date'];

    protected $touches = ['issue'];

    public function setCreatedDateAttribute($date)
    {
    	$this->attributes['created_date'] = strlen(trim($date)) ? Carbon::createFromFormat('m/d/Y H:i A', $date) : '';
    }

    public function issue()
    {
    	return $this->belongsTo('App\Issue');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
