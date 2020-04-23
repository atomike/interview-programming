<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include "LandPerimeter.php";

class LandPerimeterTest extends TestCase {
    protected function generateArr() {
      $arr = [];
      $l = rand(5, 18);
      $w = rand(5, 18);
      for($i = 0; $i < $l; $i++) {
        $s = '';
        for($j = 0; $j < $w; $j++) {
          $value = rand(0,2) == 1;
          if($value) $s .= 'X';
          else $s .= 'O';
        }
        array_push($arr, $s);
      }
      return $arr;
    }
    protected function sol($arr) {
      $count = 0;
      for($i = 0; $i < sizeof($arr); $i++) {
        for($j = 0; $j < strlen($arr[$i]); $j++) {
          if($arr[$i][$j] === 'X') {
            if($j === 0 || $arr[$i][$j-1] !== 'X') $count++;
            if($j === strlen($arr[$i]) - 1 || $arr[$i][$j+1] !== 'X') $count++;
            if($i === 0 || $arr[$i-1][$j] !== 'X') $count++;
            if($i === sizeof($arr)-1 || $arr[$i+1][$j] !== 'X') $count++;
          }
        }
      }
      return "Total land perimeter: " . $count;
    }
    public function testBasics() {
      $this->assertEquals("Total land perimeter: 60", land_perimeter(["OXOOOX", "OXOXOO", "XXOOOX", "OXXXOO", "OOXOOX", "OXOOOO", "OOXOOX", "OOXOOO", "OXOOOO", "OXOOXX"]));
      $this->assertEquals("Total land perimeter: 52", land_perimeter(["OXOOO", "OOXXX", "OXXOO", "XOOOO", "XOOOO", "XXXOO", "XOXOO", "OOOXO", "OXOOX", "XOOOO", "OOOXO"]));
      $this->assertEquals("Total land perimeter: 40", land_perimeter(["XXXXXOOO", "OOXOOOOO", "OOOOOOXO", "XXXOOOXO", "OXOXXOOX"]));
      $this->assertEquals("Total land perimeter: 54", land_perimeter(["XOOOXOO", "OXOOOOO", "XOXOXOO", "OXOXXOO", "OOOOOXX", "OOOXOXX", "XXXXOXO"]));
      $this->assertEquals("Total land perimeter: 40", land_perimeter(["OOOOXO", "XOXOOX", "XXOXOX", "XOXOOO", "OOOOOO", "OOOXOO", "OOXXOO"]));
      $this->assertEquals("Total land perimeter: 4",  land_perimeter(["X"]));
    }
    public function testRandom() {
      for($i = 0; $i < 100; $i++) {
        $t = $this->generateArr();
        $this->assertEquals($this->sol($t), land_perimeter($t));
      }
    }
}
?>
