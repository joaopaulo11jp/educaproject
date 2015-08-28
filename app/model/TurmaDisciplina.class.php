<?php
class TurmaDisciplina extends TRecord{
	const TABLENAME = 'Turma_Disciplina';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';

	$professor;
	$boletim;

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('turma_id');
		parent::addAttribute('disciplina_id');
		parent::addAttribute('professor_id');
		parent::addAttribute('boletim_id');
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

	public function get_boletim(){
		if(empty($boletim)){
			$this->boletim = new BoletimDaDisciplna($this->boletim_id);
		}
	 return $this->boletim;
	}

	public function set_boletim(BoletimDaDisciplina $boletim){
		$this->boletim = $boletim;
		$this->boletim_id = $boletim->id;
	}

}
?>