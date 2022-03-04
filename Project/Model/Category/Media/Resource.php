<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Category_Media_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('media')->setPrimaryKey('mediaId');//->setRowClassName('Category_Media_Resource');;
		parent::__construct();
	}
}
