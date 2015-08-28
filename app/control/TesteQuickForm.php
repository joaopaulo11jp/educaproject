<?php
class TesteQuickForm extends TPage{
  private $form;

	public function __construct(){
		parent::__construct();

		$this->form = new TQuickForm('matricula');
		$this->form->class = 'tform';
		$this->form->setFormTitle('Formulário de matrícula');
		

		$nome = new TEntry('nome');
		$cpf = new TEntry('cpf');
		$date = new TDate('date');
		$date->setMask('dd/mm/yyyy');
		$telefone = new TEntry('telefone1');
		$telefone->setMask('(99) 9999-999');
		$telefone2 = new TEntry('telefone2');
		$telefone2->setMask('(99) 99999-999');
		$email = new TEntry('email');
		$escolaOrigem = new TEntry('escolaDeOrigem');
		$tipoSanguineo = new TCombo('tipoSanguineo');
		$alergia = new TRadioGroup('alergia');
		$alergia->setLayout('horizontal');
		$descAlergia = new TText('descAlergia');
		$descAlergia->setSize(450,100);
		TText::disableField('matricula','descAlergia');

		$combo_items = array();
		$combo_items['A+'] = 'A+';
		$combo_items['A-'] = 'A-';
		$combo_items['B+'] = 'B+';
		$combo_items['B-'] = 'B-';
		$combo_items['O+'] = 'O+';
		$combo_items['O-'] = 'O-';
		$combo_items['AB+'] = 'AB+';
		$combo_items['AB-'] = 'AB-';

		$tipoSanguineo->addItems($combo_items);

		$combo_items = array();
		$combo_items[1] = 'Sim';
		$combo_items[2] = 'Não';

		$alergia->addItems($combo_items);


		$this->form->addQuickField('Nome',$nome,559);
		$this->form->addQuickFields('CPF',array($cpf,new TLabel('Data de Nascimento'),$date));
		$this->form->addQuickFields('Telefone',array($telefone,new TLabel('Celular'),$telefone2));
		$this->form->addQuickField('Email',$email,250);
		$this->form->addQuickField('Escola de Origem',$escolaOrigem,400);
		
		$row = $this->form->addRow();
		$row->addCell(' ');
		$row = $this->form->addRow();
		$row->class = 'tformsection';
		$thidden = new TLabel('Informações médicas');
		$thidden->setSize(800);
        $row->addCell($thidden)->colspan = 2;
		
        $this->form->addQuickField('Tipo sanguíneo',$tipoSanguineo,100);
		$this->form->addQuickField('Alergia?',$alergia,200);
		//$this->form->addQuickField('',$descAlergia,450);
		$row = $this->form->addRow();
		$row->addCell('');
		$row->addCell($descAlergia);

		$row = $this->form->addRow();
		$row->class = 'tformsection';
		$thidden = new TLabel('Dados cadastrais da Mãe');
		$thidden->setSize(800);
        $row->addCell($thidden)->colspan = 2;

        $nomeMae = new TEntry('nomeMae');
        $telMae = new TEntry('TelMae');
        $telMae->setMask('(99) 99999-999');
        $telMae2 = new Tentry('TelMae2');
        $telMae2->setMask('(99) 99999-999');
        $emailMae = new TEntry('emailMae');

        $this->form->addQuickField('Nome',$nomeMae,559);
		$this->form->addQuickFields('Telefone',array($telMae,new TLabel('Tel. Alternativo'),$telMae2));
		$this->form->addQuickField('Email',$emailMae,559);

		$row = $this->form->addRow();
		$row->addCell(' ');
		$row = $this->form->addRow();
		$row->class = 'tformsection';
		$thidden = new TLabel('Dados cadastrais do Pai');
		$thidden->setSize(800);
        $row->addCell($thidden)->colspan = 2;

        $nomePai = new TEntry('nomePai');
        $telPai = new TEntry('TelPai');
        $telPai->setMask('(99) 99999-999');
        $telPai2 = new Tentry('TelPai2');
        $telPai2->setMask('(99) 99999-999');
        $emailPai = new TEntry('emailPai');

        $this->form->addQuickField('Nome',$nomePai,559);
		$this->form->addQuickFields('Telefone',array($telPai,new TLabel('Tel. Alternativo'),$telPai2));
		$this->form->addQuickField('Email',$emailPai,559);

		$row = $this->form->addRow();
		$thidden = new TLabel('');
		$thidden->setSize(800);
        $row->addCell($thidden)->colspan = 2;
        
        $alergia->setChangeAction(new TAction(array($this,'onChangeRadio')) );


		$this->form->addQuickAction('Salvar', new TAction(array($this,'onSave')),'ico_save.png');


		parent::add($this->form);
	}

	public static function onChangeRadio($param){

		if($param['alergia'] == 2){
			TText::disableField('matricula','descAlergia');
			TText::clearField('matricula','descAlergia');
		}else{
			TText::enableField('matricula','descAlergia');
		}
	}

	public function onSave($param){
 		$data = $this->form->getData();

 		$this->form->setData($data);

 		$message = 'Id: ' . $data->id.'<br>';
 		$message .= 'Description: ' . $data->description.'<br>';
 		$message .= 'Date: ' . $data->date.'<br>';
 		$message .= 'List: ' . $data->list.'<br>';
 		$message .= 'Text: ' . $data->text.'<br>';

 		new TMessage('info','Fase de testes :)');
	}

}
?>