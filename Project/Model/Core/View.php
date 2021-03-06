<?php

class Model_Core_View
{

	public $templet = null;
	public $data = null;

	public function getUrl($action=null,$controller=null,$parameters=[],$reset=false)
	{
		$temp = [];
		$request = Ccc::getFront()->getRequest();
		
		$temp['a'] = (!$action) ? $request->getRequest('a') : $action;
		$temp['c'] = (!$controller)? $request->getRequest('c') : $controller;
		
		if($reset)
		{
			if($parameters)
			{
				$temp = array_merge($temp,$parameters);
			}
		}
		else
		{
			$temp = array_merge($_GET,$temp);
			if($parameters)
			{
				$temp = array_merge($temp,$parameters);
			}
		}
		if(($key =  array_search(null, $temp)))
		{
			unset($temp[$key]);
		}
		return 'index.php?'.http_build_query($temp);
	}



	public function setTemplate($templet)
	{
		$this->templet = $templet;
		return $this;
	}

	public function getTemplate()
	{
		return $this->templet;
	}

	public function toHtml()
	{
		ob_start();
		require($this->getTemplate());
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData($key=null)
	{
		if(!$key)
		{
			return $this->data;
		}
		if(!array_key_exists($key, $this->data))
		{
			return $this;
		}	
		return $this->data[$key];
	}


	public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __unset($key)
    {
        if (array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data)){
            return $this;
        }
        return $this;
    }
}
