<?php
class AnoLetivo extends TRecord{
	const TABLENAME = 'AnoLetivo';
	const PRIMARYKEY = 'id';
	const IDPOLICY = 'max';


	public function __construct($id = NULL){
		parent::__construct($id);
		parent::addAttribute('ano');
		parent::addAttribute('bimestre');
	}

}
?>