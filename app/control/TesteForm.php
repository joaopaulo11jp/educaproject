<?php
class TesteForm extends TPage{
	private $form;

	public function __construct(){
		parent::__construct();

		$this->form = new TForm();
		$this->form->class('tform');
		$table = new TTable();
		$this->form->add($table);

		

		parent::add($this->form);

	}
}

?>