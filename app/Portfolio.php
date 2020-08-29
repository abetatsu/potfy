<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    protected $fillable = ['title', 'description','link'];

    use SoftDeletes;

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function technologies()
    {
        return $this->belongsToMany('App\Technology')->withTimestamps();
    }
}
