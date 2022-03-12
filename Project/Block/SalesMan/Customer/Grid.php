<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_salesman_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/customer/grid.php');
	}

	public function getsalesmanCustomers()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM customer WHERE salesmanId = {$id}");
		return $salesmanCustomers;
	}

	public function getsalesmanCustomersNot()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM customer WHERE salesmanId is null");
		return $salesmanCustomers;
	}
}