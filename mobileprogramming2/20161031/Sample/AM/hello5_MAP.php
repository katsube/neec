<?php
//MAP表示
$map = [
      [0, 0, 0, 0]
    , [0, 1, 2, 0]
    , [0, 2, 1, 0]
    , [0, 0, 0, 0]
];

for($i=0; $i<count($map); $i++){
	for($j=0; $j<count($map[$i]); $j++){
		switch($map[$i][$j]){
			case 0:
				print '_';
				break;
			case 1:
				print 'A';
				break;
			case 2:
				print 'B';
				break;
			default:
				print '?';
				break;
		}
	}
	print "\n";
}


