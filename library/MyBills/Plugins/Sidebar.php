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
 * @package    MyBills
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 */

/**
 * @see Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Layout/Controller/Plugin/Layout.php';

class MyBills_Plugins_Sidebar extends Zend_Layout_Controller_Plugin_Layout
{
	
	public function postDispatch(Zend_Controller_Request_Abstract $request)
	{
		$html = '<div class="sidebar grid_5">' . $this->getLayout()->getView()->navigation(Zend_Registry::get('Sidebar'))->menu()->render() . '</div>';
		$this->getLayout()->sidebar = $html;
		parent::postDispatch($request);
	}
	
}