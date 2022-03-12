<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	{
		$customer = Ccc::getModel('Customer');
		$customers = $customer->fetchAll("select c.*,a.* from customer c join address a on a.customerId = c.customerId;");
		return $customers;
	}
}

?>