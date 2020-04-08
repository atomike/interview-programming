<?php
use PHPUnit\Framework\TestCase;

function printBoard($grid){
    echo "  012345\n";
    foreach($grid as $key=>$column){
        echo "$key ";
        foreach($column as $el){
            echo "$el[0]";
        }
        echo "\n";
    }
}

function whoIsWinner($piecesPositionList) {
    //Create an array of 7 elements each with an empty array
    $board = array_fill(0, 7, []);

    //Use flip array keys and values
    $cols = array_flip(str_split('ABCDEFG'));

    //Add one peace to the board at a time
    foreach ($piecesPositionList as $step) {
        echo "$step\n";

        $player = substr($step, 2);
        $col = $cols[$step[0]];
        $row = count($board[$col]);
        $board[$col][] = $player;

        //printBoard($board);

        //Check surrounding 3 pieces back and forth are the same as the current player
        foreach ([[1, 0], [1, 1], [0, 1], [-1, 1]] as list($dc, $dr)) {
            $count = 0;
            for ($offset = -3; $offset < 4; $offset += 1) {
                $c = $col + $dc * $offset;
                $r = $row + $dr * $offset;

                //echo "$col $c, $row $r\n";

                $count = (isset($board[$c][$r]) && $board[$c][$r] == $player) ? $count + 1 : 0;
                if ($count > 3) {
                    return $player;
                }
            }
        }
    }
    return 'Draw';
}

class connectFourCleverTest extends TestCase
{
    public function testRandom()
    {
        echo "\n";
        for ($round = 0; $round < 1; $round += 1) {
            $cols = str_split('ABCDEFG');
            $board = array_fill(0, 7, []);
            $piecesPositionList = [];

            //Pick a random player to start with
            $redPlayer = mt_rand(0, 1) > 0;
            $winner = 'Draw';
            for ($step = 0; $step < 42; $step += 1) {
                $stepCol = $cols[mt_rand(0, count($cols) - 1)];
                $player = $redPlayer ? 'Red' : 'Yellow';
                echo "$player\n";
                $piecesPositionList[] = $stepCol . '_' . $player;
                $col = strpos('ABCDEFG', $stepCol);
                $row = count($board[$col]);
                $board[$col][] = $player;
                if (count($board[$col]) > 5) {
                    $cols = array_values(array_diff($cols, [$stepCol]));
                }
                foreach ([[1, 0], [1, 1], [0, 1], [-1, 1]] as list($dc, $dr)) {
                    $count = 0;
                    for ($offset = -3; $offset < 4; $offset += 1) {
                        $c = $col + $dc * $offset;
                        $r = $row + $dr * $offset;
                        $count = isset($board[$c][$r]) && $board[$c][$r] == $player ? ($count + 1) : 0;
                        if ($count > 3) {
                            $winner = $player;
                            break 3;
                        }
                    }
                }

                //Alternate between players
                $redPlayer = !$redPlayer;
            }
            $this->assertEquals($winner, whoIsWinner($piecesPositionList));
        }
    }
}
?>
