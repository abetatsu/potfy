<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'portfolio_id', 'story', 'story_type'
    ];
    
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
        $story = e($story);
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" class="text-blue-500" target="_blank" onclick="return confirm(\'外部リンクに遷移しようとしています。本当に実行してよろしいでしょうか?\')">$1</a>';
        $text    = preg_replace($pattern, $replace, $story);
        return $text;
    }
}
