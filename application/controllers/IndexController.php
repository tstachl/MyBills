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
 * @see MyBills_Controller_Action
 */
require_once 'MyBills/Controller/Action.php';

class IndexController extends MyBills_Controller_Action
{

    public function init()
    {
    	Zend_Registry::get('logger')->info(__METHOD__);
    }

    public function indexAction()
    {
    	Zend_Registry::get('logger')->info(__METHOD__);
    	
		return $this->_helper->redirector('index', 'invoice');
    }

}

