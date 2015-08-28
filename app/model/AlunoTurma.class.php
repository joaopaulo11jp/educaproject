<?php
class AlunoTurma extends TRecord{
	const TABLENAME = 'Aluno_Turma';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';
	
	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('matricula_aluno');
		parent::addAttribute('turma_id');
	}
}
?>