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
 * @see Zend_Controller_Action
 */
require_once 'Zend/Controller/Action.php';

class LoginController extends Zend_Controller_Action
{
	
	/**
	 * Initializes the login controller.
	 * 
     * @return void
	 */
	public function init()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$this->_helper->layout->setLayout('standalone');
		$this->view->headTitle('Login');
	}
	
	/**
	 * Login index action adds the form.
	 * 
     * @return void
	 */
	public function indexAction()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$this->view->form = $this->getForm();
		
		return;
	}
	
	/**
	 * Processes login requests.
	 * 
     * @return void
	 */
	public function processAction()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$form = $this->getForm();
			
			if ($form->isValid($request->getPost())) {
				// sorry not valid
				$form->setDescription('Invalid credentials provided');
				$this->view->form = $form;
				return $this->render('index');
			}
			
			$this->view->form = $form;
			return $this->render('index');
		}
		
		return $this->_helper->redirector('index');
	}
	
	/**
	 * The login form getter.
	 * 
     * @return MyBills_Form_LoginForm
	 */
	public function getForm()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		return new MyBills_Form_LoginForm(array(
			'action' => '/login/process',
			'method' => 'post',
			'name'	 => 'login_form'
		));
	}

}

