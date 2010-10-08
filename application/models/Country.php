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

class MyBills_Model_Country extends MyBills_Model
{
	
	protected $_iso;
	protected $_name;
	protected $_iso3;
	
	public function getIso()
	{
		return $this->_iso;
	}

	public function setIso($_iso)
	{
		$this->_iso = $_iso;
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

	public function getIso3()
	{
		return $this->_iso3;
	}

	public function setIso3($_iso3)
	{
		$this->_iso3 = $_iso3;
		return $this;
	}
	
}