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

$chara = [];
$fp = fopen('data.csv', 'r');
while( ($data = fgets($fp)) !== false ){
	 $data    = rtrim($data);
	 $buff    = explode(',', $data);
	 $chara[] = $buff;
}
fclose($fp);

$card = [];
for($i=0; $i<$loop; $i++){
	$rand = mt_rand(0, count($chara)-1);
	$cur  = $chara[$rand];
	print $i+1 . '回目 '.$cur[2].' '.$cur[1].' ('.$cur[0].")\n";

	$card[] = $cur[0];
}

$fp = fopen('discharge.log', 'a');
fwrite($fp, implode("\t", [
					  date('Y-m-d H:i:s')
					, implode(',',$card)
				]));
fwrite($fp, "\n");
fclose($fp);

