<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	{
		$customerModel = Ccc::getModel('Customer');
		$customers = $customerModel->fetchAll("select c.*,a.* from customer c join address a on a.customerId = c.customerId;");
		return $customers;
		
	}
}

?>