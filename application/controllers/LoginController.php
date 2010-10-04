<?php

class LoginController extends Zend_Controller_Action
{
	
	public function init()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$this->_helper->layout->setLayout('standalone');
		$this->view->headTitle('Login');
	}
	
	public function indexAction()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$this->view->form = $this->getForm();
	}
	
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

