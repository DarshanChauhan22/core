<?php
Ccc::loadClass("Model_Core_Row");
class Model_Admin extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Admin_Resource');
	}
}


/*Ccc::loadClass('Model_Core_Table');
class Model_Admin extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('adminId');
		$this->setRowClassName('Admin_Row');
	}
}*/

?>