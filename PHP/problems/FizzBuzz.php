<?php
//FizzBuzz for numbers 3 and 5
// O(n) = n

$end=20;

for($i=0; $i<$end; $i++){
    if($i%15==0){
	echo "FizzBuzz\n";
    }
    else if($i%3==0){
	echo "Fizz\n";
    }
    else if($i%5==0){
	echo "Buzz\n";
    }
    else{
	echo "$i\n";
    }
}

?>
