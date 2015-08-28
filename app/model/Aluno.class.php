<?php
class Aluno extends TRecord{
	const TABLENAME = 'Aluno';
	const PRIMARYKEY = 'matricula';
	const IDPOLICY = 'max';

	private $turma;

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::__addAttribute('nome');
		parent::__addAttribute('endereco');
		parent::__addAttribute('telefone');
		parent::__addAttribute('telefone2');
		parent::__addAttribute('email');
		parent::__addAttribute('cpf');
		parent::__addAttribute('genero');
		parent::__addAttribute('dataNascimento');
		parent::__addAttribute('escolaOrigem');
		parent::__addAttribute('bairro');
		parent::__addAttribute('cidade');
		parent::__addAttribute('estado');
		parent::__addAttribute('grupoSanguineo');
		parent::__addAttribute('nomeDoPai');
		parent::__addAttribute('telDoPai');
		parent::__addAttribute('telDoPai2');
		parent::__addAttribute('emailDoPai');
		parent::__addAttribute('nomeDaMae');
		parent::__addAttribute('telDaMae');
		parent::__addAttribute('telDaMae2');
		parent::__addAttribute('emailDaMae');
		parent::__addAttribute('nomeResp');
		parent::__addAttribute('telResp');
		parent::__addAttribute('telResp2');
		parent::__addAttribute('emailResp2');
		parent::__addAttribute('turma_id');
		
	}

	public function get_turma(){

		if(empty($this->turma)){
			$this->turma = new Turma($this->turma_id);
		}
	  
	  	return $this->turma;
	}

	public function set_turma(Turma $turma){
		$this->turma = $turma;
		$this->turma_id = $turma->id;
	}


}

?>