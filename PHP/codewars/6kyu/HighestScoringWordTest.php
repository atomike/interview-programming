<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include "HighestScoringWord.php";

class HighestScoringWordTest extends TestCase
{
    public function testSampleTests() {
      $this->assertEquals('taxi', high('man i need a taxi up to ubud'));
      $this->assertEquals('volcano', high('what time are we climbing up the volcano'));
      $this->assertEquals('semynak', high('take me to semynak'));
    }
    
    private function highSolution($x) {
      $x=explode(" ", $x); $word = ""; $points = 0;
      for($a=0;$a<count($x);$a++){
        $num = 0;
        for($b=0;$b<strlen($x[$a]);$b++){ $num += ord($x[$a][$b])-96;}
        if($num > $points){$word = $x[$a]; $points = $num;}
      }
      return $word;
    }
    
    private function makeString() {
      $letters = "abcdefghijklmnopqrstuvwxyz";
      $wq = [];
      for ($tr=0; $tr<=rand(1,40); $tr++) {
        $qw = "";
        for ($rt=0; $rt<=rand(1,40); $rt++) {
          $qw .= $letters[rand(0, strlen($letters)-1)];
        }
        $wq[] = $qw;
      }
      return implode(" ", $wq);
    }
    
    public function testRandomTests() {
      echo "\n";
      for($cwtests=0;$cwtests<=100;$cwtests++) {
        $poi = $this->makeString();
        $qwe1 = $poi;
        $qwe2 = $poi;
        echo "Testing for '" . $qwe1 ."\n";
        $this->assertEquals($this->highSolution($qwe1), high($qwe2));
      }
    }
}
