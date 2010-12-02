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
 * @package    MyBills_View
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see Zend_View_Helper_Abstract
 */
require_once 'Zend/View/Helper/Abstract.php';

class MyBills_View_Helper_UserHelper extends Zend_View_Helper_Abstract 
{
	
	protected $_user;
	
	public function userHelper()
	{
		$userMapper = new MyBills_Model_UserMapper();
		$this->_user = $userMapper->findById(Zend_Auth::getInstance()->getIdentity()->uuid);
		return $this;
	}
	
	public function getUser()
	{
		return $this->_user;
	}
	
	public function getFullName()
	{
		return $this->getUser()->getContact()->getFirstname() . ' ' . $this->getUser()->getContact()->getName();
	}
	
}