<?php

$i = 0;

$_SESSION['a'][$i] = "lali";
$i = $i+1;

array_push($_SESSION['a'], "golu");

foreach ($_SESSION['a'] as $key => $value) {
	
	echo $key .'   '. $value.'<br>' ;
}

?>