<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function replaceUrl($story)
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" class="text-blue-500" target="_blank">$1</a>';
        $text    = preg_replace( $pattern, $replace, $story);
        return $text;    
    }
}
