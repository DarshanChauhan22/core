<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Category_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('category')->setPrimaryKey('categoryId')->setRowClassName('Category_Resource');
		parent::__construct();
	}
}


/*class Model_Category_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Category');
	}
}*/