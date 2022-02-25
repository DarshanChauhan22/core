<?php
Ccc::loadClass("Model_Core_Row");
class Model_Customer extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer_Resource');
		parent::__construct();
	}
}

/*Ccc::loadClass('Model_Core_Table');
class Model_Customer extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('customer')->setPrimaryKey('customerId');
		$this->setRowClassName('Customer_Row');
	}
}
*/
?>