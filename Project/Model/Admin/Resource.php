<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Admin_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('adminId');//->setRowClassName('Admin_Resource');
		parent::__construct();
	}
}

/*class Model_Admin_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Admin');
	}
}*/