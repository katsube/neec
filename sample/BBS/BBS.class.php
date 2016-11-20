<?php
/**
 * BBSクラス
 *
 * @author     M.Katsube <katsubemakito@gmail.com>
 * @copyright  Copyright ©2016 M.Katsube All Rights Reserved.
 * @license    MIT license
 */
 class BBS{
  //-------------------------------------------
  // 定数
  //-------------------------------------------
  const MODE_VIEW  = 'view';               //現在は未使用
  const MODE_WRITE = 'write';

  const ERRORCD_VALIDATION = 'E400V';      //validation
  const ERRORCD_NOTFOUND   = 'E404';       //ファイルが存在しない  checkLogFile()
  const ERRORCD_NOTREAD    = 'E403R';      //ファイルが読み込めない  checkLogFile()
  const ERRORCD_NOTWRITE   = 'E403W';      //ファイルに書き込めない  checkLogFile()
  const ERRORCD_WRITING    = 'E500W';      //ファイルに書き込めない
  const ERRORCD_COMMON     = 'ECOMMON';    //汎用エラー
  
  //-------------------------------------------
  // プロパティ
  //-------------------------------------------
  private $logfile   = 'bbslog.txt';
  private $error_cd  = null;
  
  static private $errors = [
      'E400V'   => '必要な項目が入力されていません'
    , 'E404'    => 'ログファイルが存在しません'            //checkLogFile()
    , 'E403R'   => 'ログファイルを読み込むことができません'  //checkLogFile()
    , 'E403W'   => 'ログファイルに書き込むことができません'  //checkLogFile()
    , 'E500W'   => 'ログファイルに書き込めませんでした'
    , 'ECOMMON' => 'システムエラーが発生しました'
  ];

 /**
  * コンストラクタ
  *
  * @param  $file  string
  * @return void
  * @access public
  */
  function __construct($file=null){
    if($file !== null){
      $this->logfile = $file;
    }
  }

  /**
   * ログファイルのチェック
   *
   * ファイルが存在するか、読み込めるか、書き込めるかについてチェックする。
   * すべての項目を満たす場合は true を返却する。
   * もし満たさない場合は error_cd にエラーコードをセットし false を返却する。
   *
   * @return boolean
   * @access public
   */
  function checkLogFile(){
    $file = $this->logfile;
    
    //-----------------------------
    // ファイルが存在する
    //-----------------------------
    if( ! is_file($file) ){
      $this->error_cd = self::ERRORCD_NOTFOUND;
      return(false);
    }
    //-----------------------------
    // ファイルが読める
    //-----------------------------
    else if( ! is_readable($file) ){
      $this->error_cd = self::ERRORCD_NOTREAD;
      return(false);
    }
    //-----------------------------
    // ファイルに書き込める
    //-----------------------------
    else if( ! is_writeable($file) ){
      $this->error_cd = self::ERRORCD_NOTWRITE;
      return(false);
    }
  
    return(true);
  }

  /**
   * エラーコードを取得
   *
   * @return string | null
   * @access public
   */
  function getErrorCD(){
    return( $this->error_cd );
  }

  /**
   * エラーメッセージを取得
   *
   * @return string | boolean
   * @access public
   */
  static function getErrorMessage($cd=null){
    if( $cd === null ){
      return( self::$errors );
    }
    
    //エラーCDが存在しない場合は汎用エラーCDをセット
    if( ! array_key_exists($cd, self::$errors) ){
      $cd = self::ERRORCD_COMMON;
    }
    
    return( self::$errors[$cd] );
  }

  /**
   * ログに書き込む
   *
   * @param  $name    string
   * @param  $message string
   * @return boolean
   * @access public
   */
  function addLog($name, $message){
    // エスケープ
    $name    = $this->_escape($name);
    $message = $this->_escape($message);

    // 文字列作成
    $str  = implode(',', [time(), $name, $message]);
    $str .= PHP_EOL;                  //PHP_EOL == ¥n 

    // 書き込み
    $ret = $this->_write($str);
  
    return($ret);
  }


  /**
   * ログを取得する
   *
   * @return array
   * @access public
   */
  function getLog(){
    // ファイルを開く
    $fp = fopen($this->logfile, 'r');
    if( $fp === false )
      return(false);
    
    // ファイルを読み込む
    $log = [];
    while( ($line = fgets($fp)) !== false ){
      $line = rtrim($line);
      $buff = explode(',', $line);
      
      $log[] = [
          'timestamp' => date('Y-m-d H:m:s', $buff[0]) 
        , 'name'      => $buff[1]
        , 'message'   => $buff[2]
      ];
    }
    fclose($fp);

    return($log);
  }

  /**
   * エラー画面へ遷移する
   *
   * @param  $cd    string
   * @return void
   * @access public
   */
  static function error($cd){
    header('Location: error.php?cd='.urlencode($cd));
  }

  /**
   * エスケープ処理
   *
   * 文字列中にカンマや改行があると誤作動を起こしてしまうため
   * 別の文字に置換、または削除をする。
   *
   * @param  $str     string
   * @return string
   * @access private
   */
  private function _escape($str){
    $str = str_replace(',',  '&#44', $str);    // 区切り文字 -> 文字参照
    $str = str_replace("\n", '<br>', $str);    // ¥n -> <br>
    $str = str_replace("\r", '',     $str);    // ¥r -> ""

    return($str);
  }

  /**
   * ログファイルに書き込む
   *
   * @param  $str     string
   * @return boolean
   * @access private
   */
  private function _write($str){
    // ファイルを開く
    $fp = fopen($this->logfile, 'a');
    if( $fp === false )
      return(false);
    
    // ロックする
    flock($fp, LOCK_EX);

    // 書き込み
    $ret = fwrite($fp,  $str);
    if( $ret === false ){
      return(false);
    }

    // ロックを解除
    flock($fp, LOCK_UN);
    
    // ファイルを閉じる
    fclose($fp);

    return(true);
  }

}