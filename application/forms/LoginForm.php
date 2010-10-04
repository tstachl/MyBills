<?php

class MyBills_Form_LoginForm extends Zend_Form
{
	
	public $elementDecorators = array(
		'ViewHelper',
		array(array('element' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
		'Errors',
		array(array('row' => 'HtmlTag'), array('tag' => 'div'))
	);
	
	public $hiddenDecorators = array(
		'ViewHelper'
	);
	
	public $buttonDecorators = array(
		'ViewHelper',
		array('HtmlTag', array('tag' => 'div', 'class' => 'button'))
	);
	
	public function init()
	{
		$username = $this->addElement('text', 'username', array(
			'decorators'	=> $this->elementDecorators,
			'value'			=> 'Username',
			'filter'		=> array('StringTrim', 'StringToLower'),
			'validators'	=> array('EmailAddress'),
			'required'		=> true
		));
				
		$password = $this->addElement('password', 'password', array(
			'decorators'	=> $this->elementDecorators,
			'filters'		=> array('StringTrim'),
			'validators'	=> array(
				'Alnum',
				array('StringLength', false, array(6, 20))
			),
			'required'		=> true
		));
		
		$hash = $this->addElement('hash', 'csrf', array(
			'decorators'=> $this->hiddenDecorators,
			'ignore'	=> true
		));
		
		$passwordtext = $this->addElement('hidden', 'passwordtext', array(
			'value'		=> 'Password',
			'decorators'=> $this->hiddenDecorators,
			'ignore'	=> true,
			'required'	=> false
		));
		
		$login = $this->addElement('submit', 'login', array(
			'decorators'=> $this->buttonDecorators,
			'required'	=> false,
			'ignore'	=> true,
			'label'		=> 'Login'
		));
		
		foreach ($this->_elements as $element) {
			$element->removeDecorator('Label');
		}
		
//		$recover = $this->addElement('button', 'recover', array(
//			'required'	=> false,
//			'ignore'	=> true,
//			'label'		=> 'Password recovery'
//		));

		$this->setDecorators(array(
			array('Description', array('placement' => 'append')),
			array('FormElements'),
			array('HtmlTag', array('tag' => 'div', 'class' => 'login_form')),
			array('Form')
		));
		
	}
	
}