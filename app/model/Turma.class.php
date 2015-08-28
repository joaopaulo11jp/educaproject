<?php
class Turma extends TRecord{
	const TABLENAME = 'Turma';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';


	private $anoLetivo;
	private $alunos;
	private $disciplinas;

	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('etapa_id');
		parent::addAttribute('anoletivo_id');
	}

	public function get_anoLetivo(){
		if(empty($this->anoLetivo)){
			$this->anoLetivo = new AnoLetivo($this->anoletivo_id);
		}

	 return $this->anoLetivo;
	}

	public function set_anoLetivo(AnoLetivo $object){
		$this->anoLetivo = $anoLetivo;
	}

	public function addAluno(Aluno $object){
		$this->alunos[] = $object;
	}

	public function get_alunos(){
		// Por questões de desempenho, estou usando lazy load na agregação
		 // Imagine uma lista de turmas, onde o usuário não precisa ver os alunos
		 // Vários objetos iriam ocupar a memória em vão.
		if(empty($alunos)){
			$this->alunos = parent::loadAggregate('Aluno','AlunoTurma','turma_id','matricula_alu',$id);
		}
		return $this->alunos;
	}

	public function get_disciplinas(){
		 // Por questões de desempenho, estou usando lazy load na agregação
		 // Imagine uma lista de turmas, onde o usuário não precisa ver as disciplinas
		 // Vários objetos iriam ocupar a memória em vão.
		if(empty($disciplinas)){
			$this->disciplinas = parent::loadAggregate('Disciplina','TurmaDisciplina','turma_id','disciplina_id',$id);
		}
	 return $this->disciplinas;	
	}

	public function clearParts(){
		$this->disciplinas = array();
	}

	public function addDisciplina(Disciplina $disciplina){
		$this->disciplinas[] = $disciplina;
	}

	public function load($id){ //sobrescrito!
		//load da agregação com turma no get_alunos !!!!!!!
		//load da agregação com turma no get_disciplinas !!!!!!!
		$anoLetivo = new AnoLetivo($this->anoletivo_id);
		return parent::load($id);
	}

	public function store(){ //sobrescrito!
		parent::store();
		parent::saveAggregate('AlunoTurma','turma_id','matricula_aluno',$this->id,$this->alunos);
		parent::saveAggregate('TurmaDisciplina','turma_id','disciplina_id',$this->id,$this->disciplinas);
	}

	public function delete($id = NULL){ //sobrescrito!
		$id = isset($id) ? $id : $this->id;

		$repository = new TRepository('TurmaDisciplina');
		$criteria = new TCriteria();
		$criteria->add(new TFilter('turma_id','=',$id));
		$repository->delete($criteria);

		$repository = new TRepository('AlunoTurma');
		$repository->delete($criteria);

		parent::delete($id);
	}

	//falta sobrescrever o delete !!!!!!!
}

?>