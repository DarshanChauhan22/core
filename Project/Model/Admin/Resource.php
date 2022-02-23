<?php

Ccc::loadClass('Model_Core_Table');
class Model_Admin_Resource extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('adminId');
		$this->setRowClassName('Admin');
	}
}

/*class Model_Admin_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Admin');
	}
}*/