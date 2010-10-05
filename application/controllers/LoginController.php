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

/**
 * @see Zend_Auth_Adapter_DbTable
 */
require_once 'Zend/Auth/Adapter/DbTable.php';

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
	
	public function preDispatch()
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		if (Zend_Auth::getInstance()->hasIdentity()) {
			// The user is logged in and can be redirected to index
			// unless he clicked the logout action
			if ('logout' != $this->getRequest()->getActionName()) {
			#	$this->_helper->redirector('index', 'index');
			}
		} else {
			// If they aren't logged in they can't logout so we redirect
			// them to the login form
			if ('logout' == $this->getRequest()->getActionName()) {
				$this->_helper->redirector('index');
			}
		}
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
				$adapter = $this->getAuthAdapter($form->getValues());
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($adapter);
				
				if ($result->isValid()) {
					$storage = $auth->getStorage();
					$storage->write($adapter->getResultRowObject(array(
						'username'
					)));
					return $this->_helper->redirector('index', 'index');
				}
				
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
	 * Clears the Zend_Auth information and redirects to index.
	 * 
     * @return void
	 */
	public function logoutAction()
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		Zend_Auth::getInstance()->clearIdentity();
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
			'name'	 => 'login_form',
			'class'	 => 'form'
		));
	}
	
	/**
	 * The authentication adpater getter.
	 * 
	 * @param array $params holding the credentials
	 */
	public function getAuthAdapter(array $params)
	{		
		$authAdapter = new Zend_Auth_Adapter_DbTable(
			Zend_Db_Table::getDefaultAdapter(),
			'user',
			'username',
			'password'
		);
		
		$user = new MyBills_Model_UserMapper();
		$user->findByUsername('thomas@stachl.me');
		
		return $authAdapter->setIdentity($params['username'])
						   ->setCredential(MyBills_Utils::crypt($params['password'], $user->password));
	}

}

