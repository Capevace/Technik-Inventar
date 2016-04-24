<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Job;
use Carbon\Carbon;

class Item extends Model
{
    protected $fillable = [
        'name', 'comment', 'total_count', 'type_id', 'img'
    ];

    protected $guard = [
        'id'
    ];

    public function type()
    {
        return $this->belongsTo('App\ItemType', 'type_id');
    }

    public function used()
    {
        return $this->hasMany('App\UsedItem', 'item_id', 'id');
    }

    public function freeCount($time_start = -1, $time_end = -1)
    {
        return $this->total_count - $this->usedCount($time_start, $time_end);
    }

    public function usedCount($time_start = -1, $time_end = -1)
    {
        if ($time_start == -1) {
            $time_start = Carbon::now();
        }

        if ($time_end == -1) {
            $time_end = Carbon::now();
        }

        $time_start = new Carbon($time_start);
        $time_end = new Carbon($time_end);

        $use_count = 0;

        foreach ($this->used as $item) {
            if ($item->job->inTimespan($time_start, $time_end))
                $use_count += $item->use_count;
        }

        return $use_count;
    }

    public function brokenCount()
    {
        return 0; // temp, add broken some time later
    }
}
