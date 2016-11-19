<?php
/**
 * BBS：エラー画面
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
// クエリの取得
//-------------------------------------------
$cd = $_REQUEST['cd'];

// エラーメッセージ取得
$message = BBS::getErrorMessage($cd);

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BBS - Error</title>
<style type="text/css">
h1{
	color: red;
}
#errormsg{
	color: red;
}
</style>
</head>
<body>

<h1>Error</h1>
<p id="errormsg"><?php print $message; ?></p>

<form>
	<input type="button" value="前の画面に戻る" onclick="history.back()">
</form>

</body>
</html>