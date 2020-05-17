<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include 'MexicanWave.php';

function randomPeople()
{
    $dictionary = str_split('abcdefghijklmnopqrstuvwxyz   ');
    shuffle($dictionary);
    return implode('', array_slice($dictionary, 0, rand(2, count($dictionary))));
}

function correctSolution($people)
{
    $sequences = [];

    for ($i = 0; $i < strlen($people);$i++) {
        if (!preg_match('/[a-z]/', $people[$i])) {
            continue;
        }

        $sequence = substr($people, 0, $i) . strtoupper($people[$i]) . substr($people, $i + 1);

        $sequences[] = $sequence;
    }

    return $sequences;
}

class MexicanWaveTest extends TestCase
{
    public function testHandMade()
    {
        $this->assertEquals(['Hello', 'hEllo', 'heLlo', 'helLo', 'hellO'], wave('hello'));
        $this->assertEquals(['Codewars', 'cOdewars', 'coDewars', 'codEwars', 'codeWars', 'codewArs', 'codewaRs', 'codewarS'], wave('codewars'));
        $this->assertEquals([], wave(''));
        $this->assertEquals(['Two words', 'tWo words', 'twO words', 'two Words', 'two wOrds', 'two woRds', 'two worDs', 'two wordS'], wave('two words'));
        $this->assertEquals([' Gap ', ' gAp ', ' gaP '], wave(' gap '));
    }

    public function testRandom()
    {
        for ($i = 0;$i < 25;$i++) {
            $people = randomPeople();

            $this->assertEquals(correctSolution($people), wave($people));
        }
    }
}
