<?php 
function printGrid($grid){
    echo "  012345\n";
    foreach($grid as $key=>$column){
        echo "$key ";
        foreach($column as $el){
            echo "$el[0]";
        }
        echo "\n";
    }
}

function checkFour($string){
    if( strpos($string, "YellowYellowYellowYellow") !== false) { return "Yellow";}
    else if( strpos($string, "RedRedRedRed") !== false) { return "Red";}
    else{ return "Draw"; }
}

function checkFourInColumn($grid){
    foreach($grid as $column){
        $string = implode("", $column);
        $winner = checkFour($string);
        if($winner=="Draw"){continue;}    
        return $winner;
    }
    
    return "Draw";
}

function checkFourInRow($grid){
    for($i=0; $i<5; $i++){
        $string = $grid["A"][$i].$grid["B"][$i].$grid["C"][$i].$grid["D"][$i].$grid["E"][$i].$grid["F"][$i].$grid["G"][$i];
        $winner = checkFour($string);
        if($winner == "Draw"){continue;}
        return $winner;
    }
    
    return "Draw";
}


function checkFourDiagonally($grid){
    $columns = ["A", "B", "C", "D", "E", "F", "G"];
    
    for($j=0; $j<=2; $j++){
        foreach($columns as $key=>$column){
            $string = "";
            $row=$j;
            for($i=$key; $i<7; $i++){
                $string .= $grid[ $columns[$i] ][$row];
                $row++;
            }
            
            $winner = checkFour($string);
            if($winner == "Draw"){continue;}
            return $winner;
        }
        
        foreach($columns as $key=>$column){
            $string = "";
            $row=$j;
            for($i=$key; $i<7; $i++){
                $string .= $grid[ $columns[6-$i] ][$row];
                $row++;
            }
            
            $winner = checkFour($string);
            if($winner == "Draw"){continue;}
            return $winner;
        }
    }
    
    return "Draw";
}

function fillGrid($pPL){    
    $grid["A"]=[];
    $grid["B"]=[];
    $grid["C"]=[];
    $grid["D"]=[];
    $grid["E"]=[];
    $grid["F"]=[];
    $grid["G"]=[];
    
    foreach($pPL as $p){
        $position = explode("_", $p);
        $grid[$position[0]][]=$position[1];
    }
    
    foreach($grid as $key=>$column){
        $size = count($column);
        for($i=$size; $i<6; $i++){
            $grid[$key][$i] = "Blank";
        }
    }
    
    return $grid;
}

function play($pPL){
    for($i=3; $i<count($pPL); $i++){
        $partial = [];
        for($j=0; $j<=$i; $j++){
            $partial[] = $pPL[$j];
        }
        
        $filledGrid = fillGrid($partial);
        if( "Draw" != $winner = checkFourInRow($filledGrid) ){ return $winner; }
        else if( "Draw" != $winner = checkFourInColumn($filledGrid) ){ return $winner; }
        else if( "Draw" != $winner = checkFourDiagonally($filledGrid) ){ return $winner; }
    }
    
    echo "D $winner"; printGrid($filledGrid);
    return "Draw";
}

function whoIsWinner($piecesPositionList)
{
    //return "Red", "Yellow" or "Draw"
    
    //Make grid
    //Add piece
    //Check if there is a winner
    //Check for 4 in a row
    //Check for 4 in a column
    //Check for 4 diagonally
    //If no winner, add another piece
    //Repeat until no pieces remain
    
    var_dump($piecesPositionList);
    return play($piecesPositionList);
}
?>
