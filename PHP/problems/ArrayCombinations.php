<?php
/*
A program to find if there are two numbers that add to target number

Big-O Time:
n(n-1) so n^2 worst case
*/

$numbers = [9, 1, 3, 5, 6, 10, 2];

function hasPairToSum($numbers, $target): bool{
    foreach($numbers as $current_key=>$num){
        foreach($numbers as $key=>$n){
            $count++;
            if($key==$current_key){continue;}

            if( ($num+$n)== $target) return true;
        }
    }

    var_dump($count);
    return false;
}

var_dump(
    hasPairToSum($numbers, 2), //false, just making sure it does not numbers to themselves
    hasPairToSum($numbers, 3), //false
    hasPairToSum($numbers, 11), //true
    hasPairToSum($numbers, 20), // false
    hasPairToSum($numbers, 19) //true
);
?>
