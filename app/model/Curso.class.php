<?php
class Curso extends TRecord{
	const TABLENAME = 'Curso';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';	

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('descricao');
	}
}
?>