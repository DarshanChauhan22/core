<?php
Ccc::loadClass('Block_Core_Layout');
Ccc::loadClass('Model_Core_Request');


class Controller_Core_Action{
	
	
	protected $message = null;
	protected $layout = null;

	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Admin_Message'));
		}
		return $this->message;
	}

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

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout){
			$this->setLayout(new Block_Core_Layout);
		}
		return $this->layout;
	}

	public function renderLayout()
	{		
		return $this->getLayout()->toHtml();	
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

	public function getBaseUrl($subUrl = null)
    {
        $url = "C:/xampp/htdocs/core/core/Project";
        if($subUrl){
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}
?>