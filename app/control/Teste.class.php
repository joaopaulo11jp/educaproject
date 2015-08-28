<?php
class Teste extends TPage{

	public function __construct(){
		parent::__construct();		
	}

	public function onHelloWorld(){
		parent::add(new TLabel('Teste onHelloWorld'));
	}
}
?>