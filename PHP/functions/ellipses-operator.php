<?php
declare(strict_types = 1);

function sum(int ...$numbers): int {
    return array_sum($numbers);
}

$numbers = [1, 2, 3, 4];
var_dump(sum(...$numbers));
