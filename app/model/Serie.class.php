<?php
class Serie extends TRecrod{
	const TABLENAME = 'Serie';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';

	$curso;

	public function __construct($id = NULL){
		parent::construct($id);
		parent::addAttribute('curso_id');
		parent::addAttribute('descricao');
		parent::addAttribute('ordem');
	}

	public function get_curso(){
		if(empty($curso)){
			$this->curso = new Curso($this->curso_id);
		}
	 return $this->curso;	
	}

	public function set_curso(Curso $curso){
		$this->curso = $curso;
		$this->curso_id = $curso->id;
	}
}
?>