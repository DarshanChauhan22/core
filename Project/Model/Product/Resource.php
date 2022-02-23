<?php

Ccc::loadClass('Model_Core_Table');
class Model_Product_Resource extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('productId');
		$this->setRowClassName('Product');
	}
}

/*class Model_Product_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Product');
	}
}*/