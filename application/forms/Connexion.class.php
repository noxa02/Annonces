<?php
class Form_connexion extends Zend_Form {
	
	public function __construct($options) {
		parent::__construct();
	
		$this->setView(new Zend_View(array('encoding','UTF-8')));
		$this->setAction('?p=account&a=connexion');
		$this->setMethod('POST');
		
		$this->addElement('text', 'login', array(
			'Label'			=> 'Idenfitiant',
			'required' 		=> true,
			'validators' 	=> array(
					'alnum',
					array('regex', false, '/^[a-zA-Z0-9]$'),
					)
		));
		
		$this->addElement('password', 'password', array(
				'Label' => 'Mot de passe',
		));

		$this->addElement('text', 'login', array(
				'Label' => 'Pseudo',
		));
		
		$this->addElement('text', 'login', array(
				'Label' => 'Pseudo',
		));
		
		$this->addElement('text', 'login', array(
				'Label' => 'Pseudo',
		));
	}
}