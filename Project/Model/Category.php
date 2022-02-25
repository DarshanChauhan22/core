<?php
Ccc::loadClass('Model_Core_Row');
class Model_Category extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Category_Resource');
	}
}


/*Ccc::loadClass('Model_Core_Table');
class Model_Category extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('category')->setPrimaryKey('categoryId');
		$this->setRowClassName('Category_Row');
	}
}
*/
?>