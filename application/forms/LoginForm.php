<?php
/**
 * MyBills
 *
 * LICENSE
 *
 * This source file is subject to the CC-GNU GPL license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/GPL/2.0/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mybills.cc so we can send you a copy immediately.
 *
 * @category   MyBills
 * @package    MyBills_Form
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see Zend_Form
 */
require_once 'Zend/Form.php';

class MyBills_Form_LoginForm extends Zend_Form
{
	
	/**
	 * Decoration for standard form elements.
	 */
	public $elementDecorators = array(
		'ViewHelper',
		array(array('element' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
		'Errors',
		array(array('row' => 'HtmlTag'), array('tag' => 'div'))
	);
	
	/**
	 * Decoration for hidden elements.
	 */
	public $hiddenDecorators = array(
		'ViewHelper'
	);
	
	/**
	 * Decoration for buttons.
	 */
	public $buttonDecorators = array(
		'ViewHelper',
		array('HtmlTag', array('tag' => 'div', 'class' => 'button'))
	);
	
	/**
	 * Initializes the form and adds elements.
	 * 
     * @return void
	 */
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
		
		return;
	}
	
}