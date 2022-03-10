<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_salesman_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('sales_Man')->setPrimaryKey('salesmanId');//->setRowClassName('salesman_Resource');
		parent::__construct();
	}
}

