<?php Ccc::loadClass('Model_Core_View'); ?>
<?php

class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $layout = null;

	public function __construct()
	{
		
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}
	public function setChildren($children)		
	{		
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($object , $key = null)		
	{
		if(!$key)
		{
			$key = get_class($object);
		}		
		$this->children[$key] = $object;
		return $this;
	}

	public function removeChild($key)
	{
		if(array_key_exists($key , $this->children))
		{
			unset($this->children[$key]);
			return $this;
		}
	}

	public function getChild($key)
	{
		if(array_key_exists($key , $this->children))
		{
			return $this->children[$key];
		}
			return null;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

}

?>