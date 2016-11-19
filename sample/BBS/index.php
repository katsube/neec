<?php
/**
 * BBS：トップ画面
 *
 * @author     M.Katsube <katsubemakito@gmail.com>
 * @copyright  Copyright ©2016 M.Katsube All Rights Reserved.
 * @license    MIT license
 */

//-------------------------------------------
// クラス読み込み
//-------------------------------------------
require('BBS.class.php');

//-------------------------------------------
// ログファイルのチェック
//-------------------------------------------
$bbs = new BBS();
if( ! $bbs->checkLogFile() ){
	//エラーコードを取得
	$cd = $bbs->getErrorCD();

	//エラー画面に遷移
	BBS::error($cd);
	exit(0);
}

//-------------------------------------------
// モード取得
//-------------------------------------------
$mode = isset($_REQUEST['mode'])?  $_REQUEST['mode']:null;

//-------------------------------------------
// ログファイルに書き込む
//-------------------------------------------
if($mode === BBS::MODE_WRITE){
	$name    = $_REQUEST['handlename'];
	$message = $_REQUEST['message'];

	//--------------
	// validation
	//--------------
	if( ($name === '') || ($message === '') ){
		BBS::error(BBS::ERRORCD_VALIDATION);
		exit(0);
	}

	//--------------
	//書き込み
	//--------------
	if( ! $bbs->addLog($name, $message) ){
		BBS::error(BBS::ERRORCD_WRITING);
		exit(0);
	}
}
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BBS</title>

<style type="text/css">
/** 書き込み **/
.log{
	border: 1px solid gray;
	margin: 5px;
	padding: 5px;
}

/** 名前 **/
.handlename{
	font-weight: bold;	/* 太字 */
}

/** 書き込み時間  **/
.timestamp{
	color: gray;		/* 文字色を灰色 */
	font-size: 80%;		/* 文字サイズを少し小さく */
}

/** 書き込み内容  **/
.message{
	/* 指定なし */
}
</style>
</head>
<body>
<h1>BBS</h1>

<!-- [書き込み用フォーム] -->
<form method="POST" onsubmit="return( confirm('この内容で書き込んでよろしいですか？') )">
<input type="hidden" name="mode" value="<?php print BBS::MODE_WRITE ?>">
<table>
<tr>
	<td>Name</td>
	<td><input type="text" name="handlename"></td>
</tr>
<tr>
	<td>Message</td>
	<td><textarea name="message" rows="5" cols="60"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="write!"></td>
</tr>
</table>
</form>
<!-- [/書き込み用フォーム] -->

<hr>

<!-- [書き込み表示] -->
<?php
	//-------------------------------------------
	// ログ表示
	//-------------------------------------------
	$log    = $bbs->getLog();
	$length = count($log);
	if($length >= 1){
		for($i=0; $i<$length; $i++){
			printf(
				  '<div class="log">'
				. '  <span class="handlename">%s</span><br> <span class="message">%s</span><br> <span class="timestamp">(%s)</span>'
				. '</div>'
					
				, $log[$i]['name']
				, $log[$i]['message']
				, $log[$i]['timestamp']
			);
		}
	}
	else{
		printf('<h3>書き込みがまだありません</h3>');
	}
?>
<!-- [/書き込み表示] -->

</body>
</html>