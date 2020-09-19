<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function replaceUrl($history)
    {
        $history = e($history);
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" class="text-blue-500" target="_blank" onclick="return confirm(\'外部リンクに遷移しようとしています。本当に実行してよろしいでしょうか?\')">$1</a>';
        $text    = preg_replace($pattern, $replace, $history);
        return $text;
    }
}
