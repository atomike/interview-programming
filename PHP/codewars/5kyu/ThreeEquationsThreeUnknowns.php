<?php
function det2x2($a, $b, $c, $d)
{
    return $a * $d - $b * $c;
}

function det3x3($a, $b, $c, $d, $e, $f, $g, $h, $i)
{
    return $a * ($e * $i - $f * $h) - $b * ($d * $i - $f * $g) + $c * ($d * $h - $e * $g);
}

function solveEq($eq)
{
    $a = $eq[0][0];
    $b = $eq[0][1];
    $c = $eq[0][2];
    $d = $eq[1][0];
    $e = $eq[1][1];
    $f = $eq[1][2];
    $g = $eq[2][0];
    $h = $eq[2][1];
    $i = $eq[2][2];

    $detA = det3x3(
        $a,
        $b,
        $c,
        $d,
        $e,
        $f,
        $g,
        $h,
        $i
    );

    $ca = det2x2($e, $f, $h, $i);
    $cd = -det2x2($d, $f, $g, $i);
    $cg = det2x2($d, $e, $g, $h);
    $cb = -det2x2($b, $c, $h, $i);
    $ce = det2x2($a, $c, $g, $i);
    $ch = -det2x2($a, $b, $g, $h);
    $cc = det2x2($b, $c, $e, $f);
    $cf = -det2x2($a, $c, $d, $f);
    $ci = det2x2($a, $b, $d, $e);

    $x = ($eq[0][3] * $ca + $eq[1][3] * $cb + $eq[2][3] * $cc) / $detA;
    $y = ($eq[0][3] * $cd + $eq[1][3] * $ce + $eq[2][3] * $cf) / $detA;
    $z = ($eq[0][3] * $cg + $eq[1][3] * $ch + $eq[2][3] * $ci) / $detA;

    return [$x, $y, $z];
}
