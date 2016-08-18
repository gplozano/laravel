<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Issue extends Model
{
    //
    protected $fillable = [
    	'issue',
    	'summary',
    	'details',
    	'type',
    	'open_date',
    	'close_date',
        'services',
        'user_id'
        
    ];


    protected $dates = ['open_date', 'close_date'];

    public function scopeOpen($query)
    {
    	$query->whereNull('close_date');
      
    }

    public function scopePerformanceDegredation($query)
    {
        $query->where('type', '=', 'Performance Degredation');
    }

    public function scopeServiceDown($query)
    {
        $query->where('type', '=', 'Service Down');
    }

    public function setOpenDateAttribute($date)
    {
    	$this->attributes['open_date'] = strlen(trim($date)) ? Carbon::createFromFormat('m/d/Y H:i A', $date) : '';
    }

    public function setCloseDateAttribute($date)
    {
        $this->attributes['close_date'] = strlen(trim($date)) ? Carbon::createFromFormat('m/d/Y H:i A', $date) : '';
    }

    public function domainStatus()
    {
        return $this->hasMany('App\DomainStatus');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
