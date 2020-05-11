<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include 'ThreeEquationsThreeUnknowns.php';

class ThreeEquationsThreeUnknownsTest extends TestCase
{
    public function testSimple()
    {
        $this->assertEquals([1, 4, -2], solveEq([[4, -3, 1, -10], [2, 1, 3, 0], [-1, 2, -5, 17]]));
        $this->assertEquals([-1, 6, 2], solveEq([[2, 1, 3, 10], [-3, -2, 7, 5], [3, 3, -4, 7]]));
        $this->assertEquals([3, -1, 2], solveEq([[3, 2, 0, 7], [-4, 0, 3, -6], [0, -2, -6, -10]]));
        $this->assertEquals([1, 0, 5], solveEq([[4, 2, -5, -21], [2, -2, 1, 7], [4, 3, -1, -1]]));
        $this->assertEquals([-2, 3, 4], solveEq([[1, 1, 1, 5], [2, 2, 3, 14], [2, -3, 2, -5]]));
    }

    public function testRandom()
    {
        for ($i = 0; $i < 200; $i++) {
            $x = random_int(0, 100);
            $x1 = random_int(0, 100);
            $x2 = random_int(0, 100);
            $x3 = random_int(0, 100);
            $y = random_int(0, 100);
            $y1 = random_int(0, 100);
            $y2 = random_int(0, 100);
            $y3 = random_int(0, 100);
            $z = random_int(0, 100);
            $z1 = random_int(0, 100);
            $z2 = random_int(0, 100);
            $z3 = random_int(0, 100);
            $eq1 = [$x1, $y1, $z1, ($x1 * $x + $y1 * $y + $z1 * $z)];
            $eq2 = [$x2, $y2, $z2, ($x2 * $x + $y2 * $y + $z2 * $z)];
            $eq3 = [$x3, $y3, $z3, ($x3 * $x + $y3 * $y + $z3 * $z)];
            echo('Equation 1: ' . json_encode($eq1) . "\n");
            echo('Equation 2: ' . json_encode($eq2) . "\n");
            echo('Equation 3: ' . json_encode($eq3) . "\n");
            echo(" - \n");
            $this->assertEquals([$x, $y, $z], solveEq([$eq1, $eq2, $eq3]));
        }
    }
}
