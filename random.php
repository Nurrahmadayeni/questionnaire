<?php  
$a=array("red","green","blue","yellow");
$random_keys=array_rand($a);
echo $a[$random_keys]. "<br/>";

for($i=0; $i<8; $i++){
	echo "Warna ". $a[$i];
}
?>