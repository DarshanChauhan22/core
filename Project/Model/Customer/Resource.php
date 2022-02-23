<?php

Ccc::loadClass('Model_Core_Table');
class Model_Customer_Resource extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('customer')->setPrimaryKey('customerId');
		$this->setRowClassName('Customer');
	}
}


/*class Model_Customer_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer');
	}
}*/