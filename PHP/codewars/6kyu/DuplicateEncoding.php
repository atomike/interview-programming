<?php
function get_positions($char, array $wa)
{
    $positions = [];
    foreach ($wa as $k => $c) {
        if ($char == $c) {
            $positions[] = $k;
        }
    }
    return $positions;
}

function duplicate_encode($word)
{
    $positions = [];
    $w = strtolower($word);
    $wa = str_split($w);
    $wa_copy = $wa;

    foreach ($wa as $char) {
        if (!isset($positions[$char])) {
            $positions[$char] = get_positions($char, $wa);
        }

        if (count($positions[$char]) == 1) {
            foreach ($positions[$char] as $pos) {
                $wa_copy[$pos] = '(';
            }
        } else {
            foreach ($positions[$char] as $pos) {
                $wa_copy[$pos] = ')';
            }
        }
    }

    return implode($wa_copy);
}
