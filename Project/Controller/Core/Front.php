<?php 


class Controller_Core_Front
{
	protected $request = NULL;
	protected $response = NULL;

	public function getRequest()
	{
		if(!$this->request)
		{
			$request = Ccc::getModel('Core_Request');
			$this->setRequest($request);
		}
		return $this->request;
	}

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse()
    {
        if(!$this->response)
        {
            $response = Ccc::getModel('Core_Response');
            $this->setResponse($response);
        }
        return $this->response;
    }
	
	public function init()
	{
		$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer' ;
		$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerName = 'Controller_'.$controllerName;
		$controllerClassName = $this->prepareClassName($controllerName);
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}

	public function prepareClassName($name)
	{
		$name = ucwords($name , "_");
		return $name;
	}
}