<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = [
        'name'
    ];
    public function portfolios()
    {
        return $this->belongsToMany('App\Portfolio')->withTimestamps();
    }
}
