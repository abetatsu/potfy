<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'gender', 'image', 'career', 'birthday', 'user_self_introduction',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function portfolios()
    {
        return $this->hasMany('App\Portfolio');
    }
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

    public function socialAccounts()
    {
        return $this->hasMany('App\SocialAccount');
    }

    public static function replaceUrl($user)
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" class="text-blue-500" target="_blank" onclick="return confirm(\'外部リンクに遷移しようとしています。本当に実行してよろしいでしょうか?\')">$1</a>';
        $text    = preg_replace($pattern, $replace, $user);
        return $text;
    }
}
