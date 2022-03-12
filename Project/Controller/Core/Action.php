<?php Ccc::loadClass('Block_Core_Layout'); ?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php

class Controller_Core_Action
{
	protected $message = null;
	protected $layout = null;

	public function __construct()
	{
		$this->authenticate();			
	}

	public function authenticate()
	{
		try 
		{
		$message = $this->getMessage();
		$action = $this->getRequest()->getRequest('a');
		$controller = ucwords($this->getRequest()->getRequest('c'),'_');

		if($controller == 'Admin_Login' && ($action == 'login' || $action == 'loginPost'))
		{
			$login = Ccc::getModel('Admin_Login')->isLoggedIn();
			if($login)
			{
				$message->addMessage('Alrady LoggedIn.');
				$this->redirect($this->getUrl('grid','product',null,true));
			}
		}
		else
		{
			$login = Ccc::getModel('Admin_Login')->isLoggedIn();
			if(!$login)
			{
				throw new Exception("First Login.");
			}
		}	
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('login','Admin_Login',null,true));	
		}
		
	}	

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

	protected function setTitle($title)
    {
        $this->getLayout()->getHead()->setTitle($title);
        return $this;
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
		echo $this->getLayout()->toHtml();	
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getResponse()
    {
        return Ccc::getFront()->getResponse();
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