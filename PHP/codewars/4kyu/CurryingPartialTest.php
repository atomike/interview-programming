<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include 'CurryingPartial.php';

class CurryingPartialTest extends TestCase
{
    public function testFunctionWithThreeRandomParameters()
    {
        $add3 = function ($a, $b, $c) {
            return $a + $b + $c;
        };
        $a = 1;
        $b = 2;
        $c = 3;
        $sum = $a + $b + $c;

        $this->assertEquals($add3($a, $b, $c), $sum);
        $this->assertEquals(curryPartial($add3)($a)($b)($c), $sum);
        $this->assertEquals(curryPartial($add3, $a)($b)($c), $sum);
        $this->assertEquals(curryPartial($add3, $a)($b, $c), $sum);
        $this->assertEquals(curryPartial($add3, $a, $b, $c), $sum);

        $this->assertEquals(curryPartial($add3, $a, $b, $c, 20), $sum);
        $this->assertEquals(curryPartial($add3)($a, $b, $c), $sum);
        $this->assertEquals(curryPartial($add3)()($a, $b, $c), $sum);
        $this->assertEquals(curryPartial($add3)()($a)()()($b, $c), $sum);
        $this->assertEquals(curryPartial($add3)()($a)()()($b, $c, 5, 6, 7), $sum);

        $this->assertEquals(curryPartial(curryPartial(curryPartial($add3, $a), $b), $c), $sum);
        $this->assertEquals(curryPartial(curryPartial($add3, $a, $b), $c), $sum);
        $this->assertEquals(curryPartial(curryPartial($add3, $a), $b, $c), $sum);

        $this->assertEquals(curryPartial(curryPartial($add3, $a), $b)($c), $sum);
        $this->assertEquals(curryPartial(curryPartial($add3, $a)($b), $c), $sum);

        $this->assertEquals(curryPartial(curryPartial(curryPartial($add3, $a)), $b, $c), $sum);
    }

    public function testFunctionWithTwoRandomParameters()
    {
        $add2 = function ($a, $b) {
            return $a + $b;
        };

        $a = 1;
        $b = 2;
        $sum = $a + $b;

        $this->assertEquals($add2($a, $b), $sum);
        $this->assertEquals(curryPartial($add2)($a)($b), $sum);
        $this->assertEquals(curryPartial($add2, $a, $b), $sum);
        $this->assertEquals(curryPartial($add2, $a, $b, 20), $sum);
        $this->assertEquals(curryPartial($add2)($a, $b), $sum);
        $this->assertEquals(curryPartial($add2)()($a, $b), $sum);
        $this->assertEquals(curryPartial($add2)()($a)()()($b), $sum);
        $this->assertEquals(curryPartial($add2)()($a)()()($b, 5, 6, 7), $sum);

        $this->assertEquals(curryPartial(curryPartial($add2, $a), $b), $sum);
    }

    public function testFunctionWithOneRandomParameter()
    {
        $double = function ($a) {
            return $a * 2;
        };

        $a = 5;
        $result = $a * 2;

        $this->assertEquals($double($a), $result);
        $this->assertEquals(curryPartial($double)($a), $result);
        $this->assertEquals(curryPartial($double, $a), $result);
        $this->assertEquals(curryPartial($double)()($a), $result);
    }

    public function testFunctionWithNoParameters()
    {
        $a = 5;

        $double = function () use ($a) {
            return $a * 2;
        };

        $result = $a * 2;

        $this->assertEquals($double(), $result);
        $this->assertEquals(curryPartial($double), $result);
    }

    public function testFunctionWithFourRandomParameters()
    {
        $add4 = function ($a, $b, $c, $d) {
            return 4 * $a + 3 * $b + 2 * $c + $d;
        };

        $a = 4;
        $b = 3;
        $c = 2;
        $d = 1;
        $sum = 4 * $a + 3 * $b + 2 * $c + $d;

        $this->assertEquals($add4($a, $b, $c, $d), $sum);
        $this->assertEquals(curryPartial($add4)($a)($b)($c)($d), $sum);
        $this->assertEquals(curryPartial($add4)($a, $b)($c)($d), $sum);
        $this->assertEquals(curryPartial($add4, $a, $b)($c)($d), $sum);
        $this->assertEquals(curryPartial($add4, $a, $b)($c, $d), $sum);
        $this->assertEquals(curryPartial(curryPartial($add4, $a, $b), $c, $d), $sum);
        $this->assertEquals(curryPartial(curryPartial($add4, $a, $b)($c), $d), $sum);
        $this->assertEquals(curryPartial(curryPartial($add4, $a)($b, $c), $d), $sum);
        $this->assertEquals(curryPartial(curryPartial(curryPartial($add4, $a), $b), $c, $d), $sum);
        $this->assertEquals(curryPartial(curryPartial(curryPartial($add4, $a), $b), $c)($d), $sum);
        $this->assertEquals(curryPartial(curryPartial(curryPartial(curryPartial($add4, $a), $b), $c), $d), $sum);
    }

    public function testStateIsntPreserved()
    {
        $add = function ($a, $b, $c) {
            return $a + $b + $c;
        };

        $add1 = curryPartial($add, 1);
        $this->assertEquals($add1(2, 3), 6);
        $this->assertEquals($add1(4, 5), 10);

        $add2 = curryPartial($add)(2);
        $this->assertEquals($add2(3, 4), 9);
        $this->assertEquals($add2(5)(6), 13);

        $it0 = [curryPartial($add)];
        $it1 = [$it0[0](0),
            $it0[0](1)];
        $it2 = [$it1[0](0), $it1[1](0),
            $it1[0](2), $it1[1](2)];
        $it3 = [$it2[0](0), $it2[1](0), $it2[2](0), $it2[3](0),
            $it2[0](4), $it2[1](4), $it2[2](4), $it2[3](4)];

        $this->assertEquals($it3, [0, 1, 2, 3, 4, 5, 6, 7], 'tree of calls');
    }
}
