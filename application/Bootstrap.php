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
 * @package    MyBills_Bootstrap
 * @copyright  Copyright (c) 2010 MyBills.cc (http://www.mybills.cc)
 * @license    http://creativecommons.org/licenses/GPL/2.0/     CC-GNU GPL License
 * @author     tstachl
 */

/**
 * @see Zend_Application_Bootstrap_Bootstrap
 */
require_once 'Zend/Application/Bootstrap/Bootstrap.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	/**
	 * Initializes the logger.
	 * 
     * @return void
	 */
	protected function _initLogger()
	{
		$logger = Zend_Log::factory(array(
			array(
				'writerName'	=> 'Stream',
				'writerParams'	=> array(
					'stream'	=> realpath(APPLICATION_PATH . '/../logs') . '/application.log'
				),
				'filterName'	=> 'Priority',
				'filterParams'	=> array(
					'priority'	=> Zend_Log::WARN
				)
			),
			array(
				'writerName'	=> 'Firebug',
				'filterName'	=> 'Priority',
				'filterParams'	=> array(
					'priority'	=> Zend_Log::INFO
				)
			)
		));
		
		$logger->info('Logger initiated');
		$logger->info(__METHOD__);
		
		Zend_Registry::set('logger', $logger);		
	}
	
	/**
	 * Initializes the autoloader and registers the custom namespaces.
	 * 
     * @return void
	 */
	protected function _initAutoloader()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace('MyBills_');
	}
	
	/**
	 * Initializes the view and adds title, scripts, css files and more.
	 * 
     * @return void
	 */
	protected function _initViewExtension()
	{
		Zend_Registry::get('logger')->info(__METHOD__);
		
		$this->bootstrap('view');
		$view = $this->getResource('view');
		
		$view->doctype('XHTML1_STRICT');
		
		$view->headLink()->appendStylesheet($view->baseUrl() . '/css/reset.css')
						 ->appendStylesheet($view->baseUrl() . '/css/text.css')
						 ->appendStylesheet($view->baseUrl() . '/css/960.css')
						 ->appendStylesheet($view->baseUrl() . '/css/login.css');
						 
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8')
						 ->appendName('author', 'Thomas Stachl')
						 ->appendName('copyright', '2010 by Thomas Stachl')
						 ->appendName('description', 'The easy billing and invoicing system.');
		
		$view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', 'text/javascript')
						   ->appendFile($view->baseUrl() . '/js/login.js', 'text/javascript');
						   
		$view->headTitle('MyBills.cc')->setSeparator(' - ')
									  ->setDefaultAttachOrder(Zend_View_Helper_Placeholder_Container_Abstract::PREPEND);
		
	}

}