<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_PaymentMethod extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/paymentMethod.php');
	}

	public function getPaymentMethods()
	{
		$paymentMethod = Ccc::getModel('PaymentMethod');
		$paymentMethods = $paymentMethod->fetchAll("SELECT * from `paymentMethod`;");
		return $paymentMethods;
	}

	public function getCart()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * from `cart` WHERE customerId = {$customerId} ;");
		return $cart;
	}
}

?>