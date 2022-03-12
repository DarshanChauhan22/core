<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php
class Model_salesman_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('sales_Man')->setPrimaryKey('salesmanId');
		parent::__construct();
	}
}

