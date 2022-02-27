<?php
Ccc::loadClass("Model_Core_Row");
class Model_Category_Media extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		parent::__construct();
	}
}

/*Ccc::loadClass('Model_Core_Table');
class Model_Product extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('productId');
		$this->setRowClassName('Product_Row');
	}
}*/

?>