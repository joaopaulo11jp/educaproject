<?php
class BoletimDaDisciplina extends TRecord{
	const TABLENAME = 'BoletimDaDisciplina';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';	
	//teste commit3
	$bimestre1;
	$bimestre2;
	$bimestre3;
	$bimestre4;
	$aluno_turma;

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttrbute('bimestre1_id');
		parent::addAttrbute('bimestre2_id');
		parent::addAttrbute('bimestre3_id');
		parent::addAttrbute('bimestre4_id');
		parent::addAttribute('mediaGlobal');
		parent::addAttribute('notaFinal');
		parent::addAttribute('final');
		parent::addAttribute('aluno_turma_id');
		// a partir de aluno_turma, essa entidade
		// terá acesso ao aluno.
	}

	public function get_bimestre1(){
		if(empty($bimestre1)){
			$this->bimestre1 = new Nota($this->bimestre1_id);
		}
	 return $this->bimestre1;
	}

	public function get_bimestre2(){
		if(empty($bimestre2)){
			$this->bimestre2 = new Nota($this->bimestre2_id);
		}
	 return $this->bimestre2;
	}

	public function get_bimestre3(){
		if(empty($bimestre3)){
			$this->bimestre3 = new Nota($this->bimestre3_id);
		}
	 return $this->bimestre3;	
	}

	public function get_bimestre4(){
		if(empty($bimestre4)){
			$this->bimestre4 = new Nota($this->bimestre4_id);
		}
	 return $this->bimestre4;	
	}

	public function set_bimestre1(Nota $nota){
		$this->bimestre1 = $nota;
		$this->bimestre1_id = $nota->id;
	}

	public function set_bimestre2(Nota $nota){
		$this->bimestre2 = $nota;
		$this->bimestre2_id = $nota->id;
	}

	public function set_bimestre3(Nota $nota){
		$this->bimestre3 = $nota;
		$this->bimestre3_id = $nota->id;
	}

	public function set_bimestre4(Nota $nota){
		$this->bimestre4 = $nota;
		$this->bimestre4_id = $nota->id;
	}

	public function set_aluno_turma(AlunoTurma $aluno_turma){
		$this->aluno_turma = $aluno_turma;
		$this->aluno_turma_id = $aluno_turma->id;		

	}

	public function load(){
		$aluno_turma = new AlunoTurma($this->aluno_turma_id);
		parent::load();
	}

}
?>