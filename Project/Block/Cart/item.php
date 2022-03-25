<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Item extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/Item.php');
	}

	public function getCartItem()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;

		$cartItem = Ccc::getModel('Cart_Item');
		$cartItem = $cartItem->fetchAll("SELECT c.itemId,p.name,c.quantity,p.price,pm.image AS baseImage from cart_item c LEFT JOIN product p on c.productId = p.productId LEFT join product_media pm on p.productId = pm.productId AND (pm.base = 1) WHERE c.cartId = {$cartId};");
		return $cartItem;
	}

	public function getOrder()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$order = $customer->getOrder();
		return $order;
	}

	public function getProducts()
	{
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT p.*,b.image AS baseImage FROM product p LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1) WHERE p.status = 1;");
		return $products;
	}
}

?>