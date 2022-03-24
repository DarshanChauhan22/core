<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_CustomerInfo extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/customerInfo.php');
	}

	public function getCustomer()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer');
		$customer = $customer->fetchRow("SELECT * from `customer` WHERE `customerId` = {$customerId};");
		return $customer;
	}
}

?>