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
 * @see MyBills_Model_Mapper_Exception
 */
require_once 'MyBills/Model/Mapper/Exception.php';

class MyBills_Model_Mapper
{
	protected $_dbTable;
	protected $_model;
	
	public function __construct($dbTable = null)
	{
		if (null !== $dbTable) {
			$this->setDbTable($dbTable);
		} else {
			$dbTable = $this->guessDbTable();
			$this->setDbTable($dbTable);
		}
	}
	
	public function __get($name)
	{
		if (null !== $this->_model) {
			$method = 'get' . $name;
			if (('mapper' == $name) || !method_exists($this->_model, $method)) {
				throw new MyBills_Model_Mapper_Exception('Invalid ' . get_class($this->_model) . ' property');
			}
			return $this->_model->$method();
		} else {
			throw new MyBills_Model_Mapper_Exception('No model saved');
			return;
		}
	}
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new MyBills_Model_Mapper_Exception('Invalid table data gateway provided');
		}
		
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		return $this->_dbTable;
	}
	
	public function save($model)
	{}
	
	public function findById($id, $model = null)
	{
		if (null === $model) {
			$model = $this->guessModel();
			$model = new $model();
		}
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$this->_model = $model->setOptions($result->current()->toArray());
		return $this->_model;
	}
	
	public function fetchAll($toArray = false)
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			if ($toArray) {
				$entries[] = $row->toArray();
			} else {
				$entry = $this->guessModel();
				$entry = new $entry();
				$entries[] = $entry->setOptions($row->toArray());
			}
		}
		return $entries;
	}
	
	public function guessModel()
	{
		return substr(get_class($this), 0, -6);
	}
	
	public function guessDbTable()
	{
		return str_replace('_Model_', '_Model_DbTable_', substr(get_class($this), 0, -6));
	}
	
}