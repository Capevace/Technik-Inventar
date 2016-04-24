<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedItem extends Model
{
    protected $fillable = [
        'job_id', 'item_id', 'use_count'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Job', 'job_id');
    }
}
