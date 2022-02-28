<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Page_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('page')->setPrimaryKey('pageId')->setRowClassName('Page_Resource');
		parent::__construct();
	}
}

/*class Model_page_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('page');
	}
}*/