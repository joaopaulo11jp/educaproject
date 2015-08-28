<?php
class Disciplina extends TRecord{
	const TABLENAME = 'Disciplina';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';

	$disciplinaPai;

	public function __construct($id = NULL){
		parent::construct($id);
		parent::addAttribute('descricao');
		parent::addAttribute('disciplina_pai_id');
	}

	public function get_disciplinaPai(){
		if(empty($disciplinaPai)){
			$this->disciplinaPai = new Disciplina($this->disciplina_pai_id);
		}

	 return $this->disciplinaPai;	
	}

	public function set_disciplinaPai(Disciplina $disciplina){
		$this->disciplinPai = $disciplina;
		$this->disciplina_pai_id = $disciplina->id;
	}
}
?>