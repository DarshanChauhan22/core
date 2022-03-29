<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Grid_Collection extends Block_Core_Template
{
	protected $pager = null;
	protected $collections = [];
	protected $columns = [];
	protected $actions= [];

	public function __construct()
	{
		$this->setTemplate('view/core/grid/collection.php');
		$this->prepareCollections();
		$this->prepareColumns();
		$this->prepareActions();
	}

	public function getColumnValue($row, $key, $column)
	{
		if ($key == 'status') 
		{
			return $row->getStatus($row->$key);
		}
		return $row->$key;
	}

	public function addColumn($key,$columns)
	{
		$this->columns[$key] = $columns;
		return $this;
	}

	public function getColumn($key)
	{
		if (!array_key_exists($key,$this->columns)) 
		{
			return null;
		}
		return $this->columns[$key];
	}

	public function addAction($action,$key)
	{
		$this->actions[$key] = $action;
		return $this;
	}

	public function getAction($key)
	{
		if (!array_key_exists($key,$this->actions)) 
		{
			return null;
		}
		return $this->actions[$key];
	}

	public function addCollection($collection,$key)
	{
		$this->collections[$key] = $collection;
		return $this;
	}

	public function getCollection($key)
	{
		if (!array_key_exists($key,$this->collections)) 
		{
			return null;
		}
		return $this->collections[$key];
	}

	public function getColumns()
	{
		return $this->columns;
	}
	
	public function prepareCollections()
	{
		return $this;
	}
	
	public function prepareColumns()
	{
		return $this;
	}
	
	public function prepareActions()
	{
		return $this;
	}
}