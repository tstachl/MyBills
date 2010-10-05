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
 * @package    MyBills_Model_Mapper
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see MyBills_Model_Mapper
 */
require_once 'MyBills/Model/Mapper.php';

class MyBills_Model_UserMapper extends MyBills_Model_Mapper
{
	
	public function save(MyBills_Model_User $user)
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		$data = array(
			'username' => $user->username,
			'password' => $user->password
		);
		
		if (null === ($uuid = $user->getUuid())) {
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('uuid = ?' => $uuid));
		}
	}
	
	public function findByUsername($username, $model = null)
	{
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		if (null === $model) {
			$model = $this->guessModel();
			$model = new $model();
		}
		
		$row = $this->getDbTable()->fetchRow(
			$this->getDbTable()->select()->where('username = ?', $username)
		);
		
		if (null === $row) {
			return;
		}
		
		$this->_model = $model->setOptions($row->toArray());
		return $this->_model;
	}
	
}