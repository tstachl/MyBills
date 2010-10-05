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

class MyBills_Form_InvoiceForm extends Zend_Form
{
	
	/**
	 * Initializes the form and adds elements.
	 * 
     * @return void
	 */
	public function init()
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
		
		$contact = $this->addElement('text', 'contact', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Type ahead, it will show you a list of existing contacts')),
				array('HtmlTag', array('tag' => 'dd')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'label'			=> 'Contact',
			'validators'	=> array('Alnum'),
			'required'		=> true
		));
		
		$pieces = $this->addElement('text', 'pieces', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Number of items to account')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'product_pieces')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'label'			=> 'Items',
			'validators'	=> array('Digits'),
			'required'		=> true
		));
		
		$name = $this->addElement('text', 'name', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Type ahead to show a list')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'product_name')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'label'			=> 'Name',
			'validators'	=> array('Alnum'),
			'required'		=> true
		));
		
		$price = $this->addElement('text', 'price', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Price for a single item')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'product_price')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'label'			=> 'Price',
			'validators'	=> array('Digits'),
			'required'		=> true
		));
		
		$product = $this->addDisplayGroup(array('pieces', 'name', 'price'), 'product');
		
		$tax = $this->addElement('text', 'tax', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Enter the sales tax for the goods in percent')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'tax_tax')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'label'			=> 'Tax %',
			'validators'	=> array('Digits'),
			'required'		=> true
		));
		
		$taxsum = $this->addElement('text', 'taxsum', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'The tax will be calculated automatically')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'tax_taxsum')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'readonly'		=> 'readonly',
			'label'			=> 'Tax Sum',
			'validators'	=> array('Digits'),
			'required'		=> true
		));
		
		$taxgroup = $this->addDisplayGroup(array('taxsum', 'tax'), 'taxstuff');
		
		$sum = $this->addElement('text', 'sum', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'The grand total will be calculated automatically')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'grandsum')),
				array('Label', array('tag' => 'dt')),
				'Errors'
			),
			'readonly'		=> 'readonly',
			'label'			=> 'Grand Sum',
			'validators'	=> array('Digits'),
			'required'		=> true
		));
		
		$create = $this->addElement('submit', 'create', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Create the invoice and see the preview')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'button')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'Create Invoice',
			'ignore'		=> true,
			'required'		=> false
		));
		
		$newbutton = $this->addElement('button', 'newrow', array(
			'decorators'	=> array(
				'ViewHelper',
				array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element', 'title' => 'Click here to create a new product row')),
				array('HtmlTag', array('tag' => 'dd', 'class' => 'button')),
				array('Label', array('tag' => 'dt'))
			),
			'label'			=> 'New Row',
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