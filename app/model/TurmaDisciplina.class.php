<?php
class TurmaDisciplina extends TRecord{
	const TABLENAME = 'Turma_Disciplina';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';

	$professor;

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('turma_id');
		parent::addAttribute('disciplina_id');
		parent::addAttribute('professor_id');
	}

	public function get_professor(){
		if(empty($professor)){
			$this->professor = new Professor($this->professor_id);
		}
	 return $this->professor;	
	}

	public function set_professor(Professor $professor){
		$this->professor = $professor;
		$this->professor_id = $this->professor->id;
	}





}
?>