<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
