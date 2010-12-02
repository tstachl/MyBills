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
 * @package    MyBills_Controller
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see MyBills_Controller_Action
 */
require_once 'MyBills/Controller/Action.php';

class ContactsController extends MyBills_Controller_Action
{
	
    public function init()
    {
    	Zend_Registry::get('logger')->info(__METHOD__);
    	parent::init();
    }
    
    public function indexAction()
    {
    	Zend_Registry::get('logger')->info(__METHOD__);
    	 	
		$this->view->title = 'Your Contacts';
		$this->view->contactForm = $this->getForm();
		$this->render();
		return $this->render('new');
    }
    
    public function newAction()
    {
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$request = $this->getRequest();
		$form = $this->getForm();
		
		if ($request->isPost()) {
			if ($form->isValid($request->getPost())) {
				var_dump($request->getPost());
			}
			
			$form->setDescription('The form is not valid');
		}
		
		$this->view->contactForm = $form;
		return $this->render();
    }
    
    public function countriesAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$countryMapper = new MyBills_Model_CountryMapper();
    	$countries = $countryMapper->fetchAll(true);
    	
    	return $this->output($countries, 'json');
    }
    
    public function statesAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$stateMapper = new MyBills_Model_StateMapper();
    	$states = $stateMapper->fetchAll(true);
    	
    	return $this->output($states, 'json');
    }
    
    public function getForm()
    {
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
    	return new MyBills_Form_ContactForm(array(
			'action' => '/contacts/new',
			'method' => 'post',
			'name'	 => 'contact_form',
			'class'	 => 'form'
    	));
    }
	
}