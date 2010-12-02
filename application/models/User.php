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
 * @package    MyBills_Model
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see MyBills_Model
 */
require_once 'MyBills/Model.php';

class MyBills_Model_User extends MyBills_Model
{
	
	protected $_uuid;
	protected $_username;
	protected $_password;
	protected $_contact;
	protected $_created;
	protected $_updated;
	
	public function getUuid()
	{
    	return $this->_uuid;
	}

	public function setUuid($_uuid)
	{
		$this->_uuid = $_uuid;
		return $this;
	}

	public function getUsername()
	{
		return $this->_username;
	}

	public function setUsername($_username)
	{
		$this->_username = $_username;
		return $this;
	}

	public function getPassword()
	{
		return $this->_password;
	}

	public function setPassword($_password)
	{
		$this->_password = $_password;
		return $this;
	}
	
	public function getContact()
	{
		return $this->_contact;
	}

	public function setContact($_contact)
	{
		$contactMapper = new MyBills_Model_ContactMapper();
		$this->_contact = $contactMapper->findById($_contact);
		return $this;
	}

	public function getCreated()
	{
		return $this->_created;
	}

	public function setCreated($_created)
	{
		$this->_created = $_created;
		return $this;
	}

	public function getUpdated()
	{
		return $this->_updated;
	}

	public function setUpdated($_updated)
	{
		$this->_updated = $_updated;
		return $this;
	}

}