<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_SalesMan_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('sales_Man')->setPrimaryKey('salesManId')->setRowClassName('SalesMan_Resource');
		parent::__construct();
	}
}

/*class Model_salesMan_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('salesMan');
	}
}*/