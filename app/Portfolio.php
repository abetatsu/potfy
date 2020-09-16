<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Portfolio extends Model
{
    public $incrementing = false;

    protected $fillable = ['title', 'description', 'link'];

    use SoftDeletes;

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function histories()
    {
        return $this->hasMany('App\History');
    }
    public function stories()
    {
        return $this->hasMany('App\Story');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function technologies()
    {
        return $this->belongsToMany('App\Technology')->withTimestamps();
    }

    public static function replaceUrl($portfolio)
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" class="text-blue-500" target="_blank" onclick="return confirm(\'外部リンクに遷移しようとしています。本当に実行してよろしいでしょうか?\')">$1</a>';
        $text    = preg_replace($pattern, $replace, $portfolio);
        return $text;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
