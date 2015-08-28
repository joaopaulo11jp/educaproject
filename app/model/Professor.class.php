<?php
class Professor extends TRecord{
	const TABLENAME = 'Aluno_Turma';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';

	public function __construct($id = NULL){
		parent::construct($id);
		parent::addAttribute('nome');
		parent::addAttribute('email');
		parent::addAttribute('telefone');
		parent::addAttribute('removido');
	}
}
?>