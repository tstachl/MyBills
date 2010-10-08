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
 */

/**
 * @see Zend_Controller_Action
 */
require_once 'Zend/Controller/Action.php';

class MyBills_Controller_Action extends Zend_Controller_Action
{
	public function init()
	{
		$this->view->headScript()->appendScript('
			window.addEvent("domready", function() {
				window.application = new MyBills("' . $this->getRequest()->getControllerName() . '");
				application.run();
			});
		');
		$this->view->headTitle(ucfirst($this->getRequest()->getControllerName()));
		parent::init();
	}
	
	public function preDispatch()
	{
		if (!Zend_Auth::getInstance()->hasIdentity() && ($this->getRequest()->getControllerName() !== 'login')) {
			// If they aren't logged in they can't logout so we redirect
			// them to the login form
			$this->_helper->redirector('index', 'login');
		}
		
		parent::preDispatch();
	}
	
	public function output($output, $format = 'json')
	{
		switch ($format) {
			case 'json':
			default:
				$this->getResponse()
						->setHeader('Content-type', 'application/json')
						->sendResponse();
				echo Zend_Json::encode($output);
				break;
		}
	}
	
}