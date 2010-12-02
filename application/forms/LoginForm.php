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
		array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
		array('HtmlTag', array('tag' => 'dd')),
		array('Label', array('tag' => 'dt')),
		'Errors'
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
		array('HtmlTag', array('tag' => 'dd', 'class' => 'button')),
		array('Label', array('tag' => 'dt'))
	);
	
	/**
	 * Initializes the form and adds elements.
	 * 
     * @return void
	 */
	public function init()
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		$username = $this->addElement('text', 'username', array(
			'decorators'	=> $this->elementDecorators,
			'label'			=> 'Username',
			'filter'		=> array('StringTrim', 'StringToLower'),
			'validators'	=> array('EmailAddress'),
			'required'		=> true,
			'attribs'		=> array('validators' => 'EmailAddress')
		));
				
		$password = $this->addElement('password', 'password', array(
			'decorators'	=> $this->elementDecorators,
			'label'			=> 'Password',
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
		
		$login = $this->addElement('submit', 'login', array(
			'decorators'=> $this->buttonDecorators,
			'required'	=> false,
			'ignore'	=> true,
			'label'		=> 'Login'
		));
		
//		$recover = $this->addElement('button', 'recover', array(
//			'required'	=> false,
//			'ignore'	=> true,
//			'label'		=> 'Password recovery'
//		));

		$this->setDecorators(array(
			array('Description', array('placement' => 'append')),
			array('FormElements'),
			array('HtmlTag', array('tag' => 'dl')),
			array('Form')
		));
		
		return;
	}
	
}