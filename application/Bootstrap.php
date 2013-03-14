<?php

/**
 * Bootstrap
 * 
 * VERY IMPORTANT
 * 
 * To add some protected function to the app
 * use with _init prefix instead init
 * 
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	protected function _initAutoload() 
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
	}	
    
    protected function _initSession() 
    {
    	Zend_Session::start();
    }
    
    protected function _initFrontRegistry() 
    {
    	$front = $this->bootstrap('frontController')->getResource('frontController');
    	$front->setParam('registry', $this->getContainer());
    }

    
    protected function _initLocale() {
    	$locale = new Zend_Locale();
    	$config = $this->getOptions();
    	$defaultLocale = $config['lang_local'];
    
    	try {
    		$locale = new Zend_Locale('auto');
    	} catch (Zend_Locale_Exception $e) {
    		$locale = new Zend_Locale($defaultLocale);
    	}
    
    	if (!isset($_SESSION['default']['locale']))
    		$_SESSION['default']['locale'] = $locale->getRegion();
    	if (!isset($_SESSION['default']['language']))
    		$_SESSION['default']['language'] = $locale->getLanguage();
    	Zend_Registry::set('Zend_Locale', $locale);
    }
    
    protected function initLang() 
    {
    	$translate = new Zend_Translate('tmx', APPLICATION_PATH . '/languages/info.xml', $_SESSION['default']['language']);
    	Zend_Registry::set('Zend_Translate', $translate);
    }
    
    
    protected function initNavigation()
    {
    	$this->bootstrap('layout');
    	$config = $this->getOptions();
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();
    	$confignav = new Zend_Config_Xml($config['navigationMenu'], 'nav');
    	$container = new Zend_Navigation($confignav);
    	$view->navigation($container);
    }
    
    protected function _initView() 
    {
    	// Initialize view
    	$this->bootstrap('layout');
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();
    	$view->addHelperPath(
    			'ZendX/JQuery/View/Helper'
    			,'ZendX_JQuery_View_Helper');
    	 
    	$view->addHelperPath('Core/View/Helper/', 'Core_View_Helper');
    
    	$view->doctype('XHTML1_STRICT');
    	$view->headTitle('TequilaTool');
    	$view->headTitle()->setSeparator(' - ');
    	$view->addBasePath(APPLICATION_PATH . '/views');
    	// Return it, so that it can be stored by the bootstrap
    	return $view;
    }    
    
    protected function _initDatabase() 
    {
    	$this->bootstrapDb();
    	$db = $this->getResource('db');
    	$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$db->query("SET NAMES 'utf8'");
    	$db->query("SET CHARACTER SET 'utf8'");
    	Zend_Registry::set("db", $db);
    	return $db;
    }
}

