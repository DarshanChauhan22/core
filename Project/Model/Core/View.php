<?php
class Model_Core_View{

	public $templet = null;
	public $data = null;


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
		require($this->getTemplate());
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

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if(!array_key_exists($key, $this->data))
		{
			return false;
		}
		unset($this->data[$key]);
		return $this;
	}
}
?>