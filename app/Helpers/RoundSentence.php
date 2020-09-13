<?php

/**
 * 文章を丸める
 * @param String $sentence
 * @param Int $limit
 * @param Int $round_num
 * @return String $sentence
 */
function RoundSentence($sentence, $limit, $round_num)
{
    if (mb_strlen($sentence) > $limit) {
        return mb_substr($sentence, 0, $round_num).'...';
    }else {
        return $sentence;
    }
}
