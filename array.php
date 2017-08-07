<?php 
	$stuff = array('orange','Banana', 'apples','Orange', 'Banana', 'banana', 'banana');

	$c = array_count_values($stuff); 
	print_r($c);
	$val = array_search(max($c), $c);

	echo "Terbanyak adalah ".$val;
?>