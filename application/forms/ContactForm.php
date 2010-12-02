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

class MyBills_Form_ContactForm extends Zend_Form
{
	
	/**
	 * Initializes the form and adds elements.
	 * 
     * @return void
	 */
	public function init()
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
		
		$firstname = $this->addElement('text', 'firstname', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Leave it empty for companies')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact firstname')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Firstname',
			'required'		=> false
		));
		
		$name = $this->addElement('text', 'name', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Enter the company or contact name')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact name')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Name',
			'required'		=> true
		));
		
		$street = $this->addElement('text', 'street', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'The street address')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact street')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Street',
			'required'		=> true
		));
		
		$streetadditional = $this->addElement('text', 'streetadditional', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Additional street information')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact streetadd')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Street Line 2',
			'required'		=> false
		));
		
		$city = $this->addElement('text', 'city', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'The city name')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact city')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'City',
			'required'		=> true
		));
		
		$state = $this->addElement('text', 'state', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Type ahead to see a list')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact state')),
				array('Label', array('tag' => 'dt'))
			),
			'readonly'		=> 'readonly',
			'label'			=> 'State',
			'required'		=> false
		));
		
		$zip = $this->addElement('text', 'zip', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'The postal or zip code')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact zip')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Zip',
			'required'		=> true
		));
		
		$country = $this->addElement('text', 'country', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Type ahead to see a list')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact country')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Country',
			'validators'	=> array('Alnum'),
			'required'		=> true
		));
		
		$email = $this->addElement('text', 'email', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Valid email address')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact email')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Email',
			'validators'	=> array('EmailAddress'),
			'required'		=> true
		));
		
		$phone = $this->addElement('text', 'phone', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Land line or cell phone number')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact phone')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Phone',
			'required'		=> false
		));
		
		$fax = $this->addElement('text', 'fax', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Fax number')),
				'Errors',
				array('HtmlTag', array('tag' => 'dd', 'class' => 'contact fax')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Fax',
			'required'		=> false
		));
		
		$create = $this->addElement('submit', 'create', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Create the contact')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'button')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Create Contact',
			'ignore'		=> true,
			'required'		=> false
		));
		
		$this->setDecorators(array(
			array('Description', array('placement' => 'append')),
			array('FormElements'),
			array('HtmlTag', array('tag' => 'dl')),
			array('Form')
		));
		
		return;
	}
	
}