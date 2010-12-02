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

class MyBills_Model_Contact extends MyBills_Model
{
	
	protected $_id;
	protected $_firstname;
	protected $_name;
	protected $_street;
	protected $_streetadditional;
	protected $_state;
	protected $_city;
	protected $_zip;
	protected $_country;
	protected $_phone;
	protected $_fax;
	protected $_created;
	protected $_updated;
	
	public function getId()
	{
		return $this->_id;
	}

	public function setId($_id)
	{
		$this->_id = $_id;
		return $this;
	}

	public function getFirstname()
	{
		return $this->_firstname;
	}

	public function setFirstname($_firstname)
	{
		$this->_firstname = $_firstname;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setName($_name)
	{
		$this->_name = $_name;
		return $this;
	}

	public function getStreet()
	{
		return $this->_street;
	}

	public function setStreet($_street)
	{
		$this->_street = $_street;
		return $this;
	}

	public function getStreetadditional()
	{
		return $this->_streetadditional;
	}

	public function setStreetadditional($_streetadditional)
	{
		$this->_streetadditional = $_streetadditional;
		return $this;
	}

	public function getState()
	{
		return $this->_state;
	}

	public function setState($_state)
	{
		$statesMapper = new MyBills_Model_StateMapper();
		$this->_state = $statesMapper->findById($_state);
		return $this;
	}

	public function getCity()
	{
		return $this->_city;
	}

	public function setCity($_city)
	{
		$this->_city = $_city;
		return $this;
	}

	public function getZip()
	{
		return $this->_zip;
	}

	public function setZip($_zip)
	{
		$this->_zip = $_zip;
		return $this;
	}

	public function getCountry()
	{
		return $this->_country;
	}

	public function setCountry($_country)
	{
		$countryMapper = new MyBills_Model_CountryMapper();
		$this->_country = $countryMapper->findById($_country);
		return $this;
	}

	public function getPhone()
	{
		return $this->_phone;
	}

	public function setPhone($_phone)
	{
		$this->_phone = $_phone;
		return $this;
	}

	public function getFax()
	{
		return $this->_fax;
	}

	public function setFax($_fax)
	{
		$this->_fax = $_fax;
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