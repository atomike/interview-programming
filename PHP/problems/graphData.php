<?php

/*
   Suppose we have some input data describing a graph of relationships between parents and children over multiple generations. The data is formatted as a list of (parent, child) pairs, where each individual is assigned a unique integer identifier.

   For example, in this diagram, 3 is a child of 1 and 2, and 5 is a child of 4:

   1   2    4
   \ /   / | \
   3   5  8  9
   \ / \     \
   6   7    11


   Sample input/output (pseudodata):

   parentChildPairs = [
   (1, 3), (2, 3), (3, 6), (5, 6),
   (5, 7), (4, 5), (4, 8), (4, 9), (9, 11)
   ]

   Write a function that takes this data as input and returns two collections: one containing all individuals with zero known parents, and one containing all individuals with exactly one known parent.


   Output may be in any order:

   findNodesWithZeroAndOneParents(parentChildPairs) => [
   [1, 2, 4],       // Individuals with zero parents
   [5, 7, 8, 9, 11] // Individuals with exactly one parent
   ]

   n: number of pairs in the input


   Steps:
   // Organize in data structure
   // Use data stuct to create two methods

   (parent, child)
 */

$parent_child_pairs = array(
    array(1, 3),
    array(2, 3),
    array(3, 6),
    array(5, 6),
    array(5, 7),
    array(4, 5),
    array(4, 8),
    array(4, 9),
    array(9, 11)
);

/*
   Nice chatting with you
   If you'd like to keep working you'll have access to the enviornment untill you close out of it.

   Have a good week :) 

   Mike: Thanks. I'll finish it. 


   One method you can take for this question is storing all of the parents in your associative array intially with a empty array.

   So children get mapped to parents on each iteration
   and parents get mapped to nothing or []

   that way when you're done with your iteration zero parent nodes will have no value aka []

   Mike: I see it, thanks. 

   Cool, nice chatting with you again, have a good one :D
 */




function to_associative_array($parent_child_pairs){
    $associative_child_parents = [];
    
    foreach($parent_child_pairs as $pair){
        
        if( ! isset($associative_child_parents[ $pair[1] ] ) ){
            $associative_child_parents[ $pair[1] ] = array($pair[0]);
        }
        else{
            $associative_child_parents[ $pair[1] ][] = $pair[0];
        }
        
        if( ! isset($associative_child_parents[ $pair[0] ]) ){
            $associative_child_parents[ $pair[0] ] = [];
        }
    }
    
    return $associative_child_parents;
}

function findNodesWithZeroAndOneParents($parentsChildPair){
    $aa = to_associative_array($parentsChildPair);
    
    $zero_parent = [];
    foreach($aa as $key=>$el){
        if(sizeof($el)==0){
            $zero_parent[] = $key;
        }
    }
    
    $one_parent = [];
    foreach($aa as $key=>$el){
        if(sizeof($el)==1){
            $one_parent[] = $key;
        }
    }
    
    return array($zero_parent, $one_parent);
}

var_dump(findNodesWithZeroAndOneParents($parent_child_pairs));

?>
