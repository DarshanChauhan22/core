<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Order_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('orders')->setPrimaryKey('orderId');
		parent::__construct();
	}
}


