<?php
function invert(&$ref)
{
    $ref = !$ref;
}

function enable_cell_lines(&$hl, &$vl, $i, $j)
{
    invert($hl[$i][$j]);
    invert($hl[$i + 1][$j]);
    invert($vl[$i][$j]);
    invert($vl[$i][$j + 1]);
}

function land_perimeter($arr)
{
    $rows = count($arr);
    $columns = strlen($arr[0]);

    $hl = array_fill(0, $rows + 1, array_fill(0, $columns, false));
    $vl = array_fill(0, $rows, array_fill(0, $columns + 1, false));

    foreach ($arr as $i => $row) {
        $cells = str_split($row);
        foreach ($cells as $j => $cell) {
            if ($cell == 'X') {
                enable_cell_lines($hl, $vl, $i, $j);
            }
        }
    }

    $sum = 0;
    foreach ($hl as $h) {
        $sum += array_sum($h);
    }
    foreach ($vl as $v) {
        $sum += array_sum($v);
    }

    return "Total land perimeter: $sum";
}
