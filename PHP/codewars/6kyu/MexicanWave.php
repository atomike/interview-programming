<?php
function wave($people)
{
    if ($people == '') {
        return [];
    }
    $wave = [];
    $people = str_split($people);
    foreach ($people as $key => $p) {
        if ($p == ' ') {
            continue;
        }
        $wave[] = (function () use ($key, $p, $people) {
            $people[$key] = strtoupper($p);
            return implode($people);
        })();
    }
    return $wave;
}
