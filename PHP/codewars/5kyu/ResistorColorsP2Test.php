<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include "ResistorColorsP2.php";

class ResistorColorsP2Test extends TestCase
{
    public function testSomeCommonResistorValues()
    {
        $this->assertEquals("brown black black gold", encodeResistorColors("10 ohms"));
        $this->assertEquals("yellow violet black gold", encodeResistorColors("47 ohms"));
        $this->assertEquals("brown black brown gold", encodeResistorColors("100 ohms"));
        $this->assertEquals("red red brown gold", encodeResistorColors("220 ohms"));
        $this->assertEquals("orange orange brown gold", encodeResistorColors("330 ohms"));
        $this->assertEquals("yellow violet brown gold", encodeResistorColors("470 ohms"));
        $this->assertEquals("blue gray brown gold", encodeResistorColors("680 ohms"));
        $this->assertEquals("brown black red gold", encodeResistorColors("1k ohms"));
        $this->assertEquals("yellow violet red gold", encodeResistorColors("4.7k ohms"));
        $this->assertEquals("brown black orange gold", encodeResistorColors("10k ohms"));
        $this->assertEquals("red red orange gold", encodeResistorColors("22k ohms"));
        $this->assertEquals("yellow violet orange gold", encodeResistorColors("47k ohms"));
        $this->assertEquals("brown black yellow gold", encodeResistorColors("100k ohms"));
        $this->assertEquals("orange orange yellow gold", encodeResistorColors("330k ohms"));
        $this->assertEquals("brown black green gold", encodeResistorColors("1M ohms"));
        $this->assertEquals("red black green gold", encodeResistorColors("2M ohms"));
    }
    public function testRandomResistors()
    {
        function myEncodeResistorColors($ohmsString)
        {
            $codes = array("0" => "black", "1" => "brown", "2" => "red", "3" => "orange", "4" => "yellow", "5" => "green", "6" => "blue", "7" => "violet", "8" => "gray", "9" => "white", "k" => 1000, "M" => 1000000);
            $ohms = substr($ohmsString, 0, strpos($ohmsString, " "));
    
            if (in_array($ohms[strlen($ohms) - 1], array("k", "M"))) {
                $magnitude = $codes[$ohms[strlen($ohms) - 1]];
                $ohms = substr($ohms, 0, strlen($ohms) - 1);
            } else {
                $magnitude = 1;
            }
    
            $firstBand = $codes[$ohms[0]];
            $secondBand = $codes[strlen($ohms) == 1 ? "0" : ($ohms[1] != "." ? $ohms[1] : $ohms[strlen($ohms) - 1])];
            $thirdBand = $codes[(string) (((int) log10((float) $ohms * $magnitude)) - 1)];
    
            return "$firstBand $secondBand $thirdBand gold";
        }

        for ($i = 0; $i < 50; $i++) {
            // Test case resistor values will all be between 10 ohms and 990M ohms
            $ohmsValue = ((rand(1, 9) * 10) + rand(0, 9)) * pow(10, rand(0, 7));
            if (floor($ohmsValue / 1000000) > 0) {
                $randomOhmsString = (string) ($ohmsValue / 1000000.0) . "M ohms";
            } elseif (floor($ohmsValue / 1000) > 0) {
                $randomOhmsString = (string) ($ohmsValue / 1000.0) . "k ohms";
            } else {
                $randomOhmsString = (string) $ohmsValue . " ohms";
            }

            echo "Testing with $randomOhmsString", "\n";
            $expected = myEncodeResistorColors($randomOhmsString);
            $actual = encodeResistorColors($randomOhmsString);
            $this->assertEquals($expected, $actual);
        }
    }
}
