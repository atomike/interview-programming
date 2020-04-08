<?php
/*
This is a problem related to recursion

The key is in identifying that solving the tower
requires repeating a known solution,

GOAL: Get all disks in decending order to PEG 3
RULE: Cannot place bigger disk on top of smaller one

How to solve hanoi 1:
Move from PEG 1 to PEG 3

How to solve hanoi 2:
Move from PEG 1 to PEG 2. This is hanoi 1 but from PEG 1 to PEG 2
Move from PEG 1 to PEG 3. This is hanoi 1
Move from PEG 2 to PEG 3. This is hanoi 1 but from PEG 2 to PEG 3

How to solve hanoi 3:
Move top 2 disks on PEG 1 to PEG 2{
   This is hanoi 2 but from PEG 1 to PEG 2
}
Move from PEG 1 to PEG 3{
    This is hanoi 1
}
Move 2 disks from PEG 2 to PEG 3 {
   This is hanoi 2 but from PEG 2 to PEG 3
}

How to solve hanoi N:
hanoi N-1 from PEG 1 to PEG 2
hanoi 1
hanoi N-1 from PEG 2 to PEG 3

Big-O Time
hanoi 1 takes 1 step
hanoi 2 takes 3 steps
hanoi 3 takes 7 steps

hanoi 4 takes 15 steps:
   takes 7 steps from hanoi 3
   takes 1 step from hanoi 1
   takes 7 steps from hanoi 3

So in general it takes 2^N-1 steps to complete hanoi N

O(n) = 2^n


Big-O Space
3N
*/

function hanoi($size, $source_peg, $buffer_peg, $destination_peg) {
    if(1==$size){
        echo "Move from PEG $source_peg to PEG $destination_peg\n";
    }
    else{
        hanoi($size-1, $source_peg, $destination_peg, $buffer_peg);
        hanoi(1, $source_peg, $buffer_peg, $destination_peg);
        hanoi($size-1, $buffer_peg, $source_peg, $destination_peg);
    }
}

hanoi(3, 1,2,3);
?>
