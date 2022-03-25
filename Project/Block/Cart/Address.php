<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Address extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/address.php');
	}

	public function getCustomer()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		$customer = $customer->fetchRow("SELECT * from `customer` WHERE `customerId` = {$customerId} ");
		return $customer;
	}
	
	public function getBillingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		$customer = $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND billing = 1;");
		return $customer;
	}

	public function getCartBillingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		//print_r($cartId); die;
		$customer = $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND billing = 1;");
		return $customer;
	}

	public function getShippingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		$shippingAddress = $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND shipping = 1;");

		return $shippingAddress;
	}

	public function getCartShippingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		$customer = $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND shipping = 1;");
		return $customer;
	}
}

?>