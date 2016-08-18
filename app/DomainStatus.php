<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DomainStatus extends Model
{
	protected $table = 'domain_status';
    //
    protected $fillable = [
    	'issue_id',
    	'domain',
        'farm',
    	'domain_id',
    	'start_time',
    	'end_time',
    	'service'
    ];
    
    public function setStartTimeAttribute($date)
    {
        $this->attributes['start_time'] = strlen(trim($date)) ? Carbon::createFromFormat('m/d/Y H:i A', $date) : '';
    }

    public function setEndTimeAttribute($date)
    {
        $this->attributes['end_time'] = strlen(trim($date)) ? Carbon::createFromFormat('m/d/Y H:i A', $date) : '';
    }

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }
}
