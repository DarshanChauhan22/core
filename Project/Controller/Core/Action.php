<?php
Ccc::loadClass('Model_Core_View');
Ccc::loadClass('Model_Core_Request');


class Controller_Core_Action{
	
	
	public $view = null;

	public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
	
	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if(!$this->view){
			$this->setView(new Model_Core_View);
		}
		return $this->view;
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
		//var_dump($a);
		//exit();
	}
	public function getUrl($action=null,$controller=null,$parameters=[],$reset=false)
    {
    	$tmp = [];
    	if(!$controller)
    	{
    		$tmp['c'] = $this->getRequest()->getRequest('c'); 
    	}
    	else
    	{
    		$tmp['c'] = $controller;
    	}

    	if(!$action)
    	{
    		$tmp['a'] = $this->getRequest()->getRequest('a'); 
    	}
    	else
    	{
    		$tmp['a'] = $action;
    	}

    	if($reset)
    	{
    		if($parameters)
    		{
    			$tmp = array_merge($tmp,$parameters);
    		}
    	}
    	else
    	{
    		$tmp = array_merge($_GET,$tmp);
    		if($parameters)
    		{
    			$tmp = array_merge($tmp,$parameters);
    		}
    	}
    	$url = 'index.php?'.http_build_query($tmp);
    	return $url;
}
}
?>