<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php
class Model_Customer_Address_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('address')->setPrimaryKey('addressId');
		parent::__construct();
	}
}

