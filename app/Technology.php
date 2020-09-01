<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function portfolios()
    {
        return $this->belongsToMany('App\Portfolio')->withTimestamps();
    }
}
