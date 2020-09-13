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
        $stories = explode(PHP_EOL, $story); //PHP_EOLは,改行コードをあらわす.改行があれば分割する
        $pattern = '/^https?:\/\/[^\s  \\\|`^"\'(){}<>\[\]]*$/'; //正規表現パターン
        $replacedstories = array(); //空の配列を用意

        foreach ($stories as $value) {
            $replace = preg_replace_callback($pattern, function ($matches) {
            //storyが１行ごとに正規表現にmatchするか確認する
                if (isset($matches[1])) {
                    return $matches[0]; //$matches[0] がマッチした全体を表す
                }
            //既にリンク化してあれば置換は必要ないので、配列に代入
                return '<a href="' . $matches[0] . '" target="_blank" rel="noopener">' . $matches[0] . '</a>';
            }, $value);
            $replacedstories[] = $replace;
            //リンク化したコードを配列に代入
        }
        return implode(PHP_EOL, $replacedstories);
        //配列にしたstoryを文字列にする
    }
}
