<?php
Ccc::loadClass("Model_Core_Row");
class Model_Product extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Product_Resource');
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