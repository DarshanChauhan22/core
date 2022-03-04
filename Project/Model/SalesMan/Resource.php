<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_SalesMan_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('sales_Man')->setPrimaryKey('salesManId');//->setRowClassName('SalesMan_Resource');
		parent::__construct();
	}
}

