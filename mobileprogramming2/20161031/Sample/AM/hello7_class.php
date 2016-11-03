<?php
class Foo{
	const MAX = 99999;
	public $val;
	
	function __construct($val){
		if( self::MAX > $val ){
			$this->val = $val;
		}
	}
	
	function bar(){
		print 'I am bar()';
	}
}

$obj = new Foo(12345);
$obj->bar();
?>
