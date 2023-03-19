<?php

function escapeElasticReservedChars($string): array|string|null
{
    $regex = "/[\\+\\-\\=\\&\\|\\!\\(\\)\\{\\}\\[\\]\\^\\\"\\~\\*\\<\\>\\?\\:\\\\\\/]/";

    return preg_replace($regex, addslashes('\\$0'), $string);
}
