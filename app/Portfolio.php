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
        $portfolios = explode(PHP_EOL, $portfolio); //PHP_EOLは,改行コードをあらわす.改行があれば分割する
        $pattern = '/^https?:\/\/[^\s  \\\|`^"\'(){}<>\[\]]*$/'; //正規表現パターン
        $replacedportfolios = array(); //空の配列を用意

        foreach ($portfolios as $value) {
            $replace = preg_replace_callback($pattern, function ($matches) {
                //portfolioが１行ごとに正規表現にmatchするか確認する
                if (isset($matches[1])) {
                    return $matches[0]; //$matches[0] がマッチした全体を表す
                }
                //既にリンク化してあれば置換は必要ないので、配列に代入
                return '<a href="' . $matches[0] . '" target="_blank" rel="noopener">' . $matches[0] . '</a>';
            }, $value);
            $replacedportfolios[] = $replace;
            //リンク化したコードを配列に代入
        }
        return implode(PHP_EOL, $replacedportfolios);
        //配列にしたportfolioを文字列にする
    }
}
