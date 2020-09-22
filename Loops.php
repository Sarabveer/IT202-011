<?php

// 1. Create an array/collection of numbers
$array = [ 6, 8, 11,	19,	34,	41,	50, 84, 87, 96 ];

// 2. Create a loop that loops over each number and shows their value.
echo 'Array:';
foreach($array as $num) {
  echo ' '.$num;  
}
echo "\n";

// 3. Have the loop output only even numbers regardless of how long the array/collection is.
echo 'Even Numbers:';
foreach($array as $num) {
  if($num % 2 == 0) {
    echo ' '.$num;
  } 
}

?>
