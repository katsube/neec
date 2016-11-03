<?php
$board = new OthelloBoard(8, 8);

//座標 1,3 に白のコマを配置
$ret = $board->set(1, 3, OthelloBoard::WHITE);
if($ret === false){
	print "そこにコマは置けません";
}
else{
	//盤面を表示
	$board->printboard();
}

class OthelloBoard{
	const WHITE = 1;
	const BLACK = 2;

	function __construct($w, $h){}
	function set($x, $y, $type){}
	function printboard(){}
}

