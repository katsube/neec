<?php
if(count($argv)===1){
	$loop = 1;
}
else if( 1<=$argv[1] && $argv[1]<=10 ){
	$loop = $argv[1];
}
else{
	print "Error: Option is not intger\n";
	exit();
}

$chara = [
	  ['ID101','バハムート','SR']
	, ['ID201','イフリート','R']
	, ['ID202','シヴァ','R']
	, ['ID203','タイタン','R']
	, ['ID301','チョコボ','N']
	, ['ID302','デブチョコボ','N']
	, ['ID303','モーグリ','N']
	, ['ID304','カーバンクル','N']
	, ['ID305','ケットシー','N']
	, ['ID306','サボテンダー','N']
];


for($i=0; $i<$loop; $i++){
	$rand = mt_rand(0, count($chara));
	$cur  = $chara[$rand];
	
	print $i+1 . '回目 '.$cur[2].' '.$cur[1].' ('.$cur[0].")\n";
}
