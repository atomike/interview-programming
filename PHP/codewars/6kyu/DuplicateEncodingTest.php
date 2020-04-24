<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include 'DuplicateEncoding.php';

class DuplicateEncodingTest extends TestCase
{
    public function testBasicTests()
    {
        $this->assertEquals('(((', duplicate_encode('din'));
        $this->assertEquals('()()()', duplicate_encode('recede'));
        $this->assertEquals(')())())', duplicate_encode('Success'), 'should ignore case');
        $this->assertEquals('()(((())())', duplicate_encode('CodeWarrior'));
        $this->assertEquals(')()))()))))()(', duplicate_encode('Supralapsarian'), 'should ignore case');
        $this->assertEquals('))))))', duplicate_encode('iiiiii'), 'duplicate-only-string');
    }

    public function testWithParenthesises()
    {
        $this->assertEquals('))((', duplicate_encode('(( @'));
        $this->assertEquals(')))))(', duplicate_encode(' ( ( )'));
    }

    public function testSomeRandoms()
    {
        for ($x = 0; $x < 5; $x++) {
            $str = $this->generateRandomString(rand(10, 20));
            $this->assertEquals($this->solution($str), duplicate_encode($str));
        }
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function solution($word)
    {
        $len = strlen($word);
        $lower = strtolower($word);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= substr_count($lower, $lower[$i]) > 1 ? ')' : '(';
        }
        return $res;
    }
}
