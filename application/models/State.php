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

class MyBills_Model_State extends MyBills_Model
{
	
	protected $_id;
	protected $_country;
	protected $_name;
	protected $_abbrev;
	
	public function getId()
	{
		return $this->_id;
	}

	public function setId($_id)
	{
		$this->_id = $_id;
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

	public function getName()
	{
		return $this->_name;
	}

	public function setName($_name)
	{
		$this->_name = $_name;
		return $this;
	}

	public function getAbbrev()
	{
		return $this->_abbrev;
	}

	public function setAbbrev($_abbrev)
	{
		$this->_abbrev = $_abbrev;
		return $this;
	}

}