<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

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