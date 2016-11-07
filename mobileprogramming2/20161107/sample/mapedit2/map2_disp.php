<?php

for($i=1; $i<=16; $i++){
	$key = 'tile'.$i;
	dispmap($_REQUEST[$key]);
	
	if($i%4 === 0){
		print '<br>';
	}
}

function dispmap($value){
	switch($value){
		case 0:
		case 1:
		case 2:
			print "<img src='image/$value.png'>";
			break;
		default:
			print '?';
			break;
	}
}

