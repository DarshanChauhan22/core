<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_ShippingMethod_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('shippingMethod')->setPrimaryKey('methodId');
		parent::__construct();
	}
}



