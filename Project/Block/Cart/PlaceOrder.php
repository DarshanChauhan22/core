<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_PlaceOrder extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/PlaceOrder.php');
	}

	public function getCartItems()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;

		$cartItem = Ccc::getModel('Cart_Item');
		$cartItem = $cartItem->fetchAll("SELECT c.itemId,p.name,c.quantity,p.price,pm.image AS baseImage,c.taxAmount,c.discount from cart_item c LEFT JOIN product p on c.productId = p.productId LEFT join product_media pm on p.productId = pm.productId AND (pm.base = 1) WHERE c.cartId = {$cartId};");
		return $cartItem;
	}

	public function getCart()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');	
		$cart = Ccc::getModel('Cart');
		$carts = $cart->fetchRow("SELECT * from `cart` WHERE `customerId` = {$customerId};");
		return $carts;
	}
}

?>