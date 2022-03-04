<?php
Ccc::loadClass("Model_Core_Row");
class Model_Customer_Address extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
		parent::__construct();
	}
}

/*Ccc::loadClass('Model_Core_Table');
class Model_Customer_Address_Resource extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('address')->setPrimaryKey('addressId');
		$this->setRowClassName('Customer_Address');
	}
}*/

?>