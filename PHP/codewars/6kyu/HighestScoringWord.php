<?php
function word_score(string $word){
  $chars = str_split($word);
  $sum = 0;
  foreach($chars as $char){
    $sum += ord($char)-96;
  }
  return $sum;  
}

function high($x) {
  $words = explode(" ", $x);
  
  $max=0;
  $max_index=0;
  foreach($words as $i=>$word){
    $word_score = word_score($word);
    if( $word_score > $max ){$max=$word_score;$max_index=$i;}
  }
  
  return $words[$max_index];
}
