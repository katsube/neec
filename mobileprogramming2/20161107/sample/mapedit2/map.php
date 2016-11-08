<?php
$map = [
      [0, 0, 0, 0]
    , [0, 1, 2, 0]
    , [0, 2, 1, 0]
    , [2, 2, 2, 2]
];

for($i=0; $i<count($map); $i++){
	for($j=0; $j<count($map[$i]); $j++){
		dispmap($map[$i][$j]);
	}
	print "<br>\n";
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

