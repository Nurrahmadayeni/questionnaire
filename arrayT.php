
<?php
$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');

$key = array_search(3, $array); // $key = 2;
$key2 = array_search('red', $array);   // $key = 1;

echo $key.' key 2 : '. $key2;
?>
