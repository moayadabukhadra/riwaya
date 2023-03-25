<?php

function escapeElasticReservedChars($string): array|string|null
{
    $regex = "/[\\+\\-\\=\\&\\|\\!\\(\\)\\{\\}\\[\\]\\^\\\"\\~\\*\\<\\>\\?\\:\\\\\\/]/";

    return preg_replace($regex, addslashes('\\$0'), $string);
}

function summary($text, $length = 100, $end = '...')
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }

    $text = mb_substr($text, 0, $length - mb_strlen($end));
    $text = mb_substr($text, 0, mb_strrpos($text, ' '));

    return $text . $end;
}
