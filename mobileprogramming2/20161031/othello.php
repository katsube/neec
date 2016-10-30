<?php
//インスタンス生成
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

/**
 * オセロ盤クラス
 */
class OthelloBoard{
	
}