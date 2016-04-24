<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name', 'description', 'leader', 'recipent', 'is_rental', 'time_start', 'time_end'
    ];

    public function items()
    {
        return $this->hasMany('App\UsedItem', 'job_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'leader');
    }

    public function inTimespan($time_start, $time_end)
    {
        $job_time_start = new \Carbon\Carbon($this->time_start);
        $job_time_end = new \Carbon\Carbon($this->time_end);

        $before = $time_start->lt($job_time_start) && $time_end->lt($job_time_start);
        $after = $time_start->gt($job_time_end) && $time_end->gt($job_time_end);

        return !$before && !$after;
    }
}
