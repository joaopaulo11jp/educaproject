<?php
class Observacao extends TRecord{
	const TABLENAME = 'Observacao';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';
	//Rever
	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('aluno_turma_id');
	}
}
?>