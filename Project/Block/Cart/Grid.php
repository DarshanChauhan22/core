<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Grid extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}

	public function getCarts()
	{
		$cart = Ccc::getModel('Cart');
		$carts = $cart->fetchAll("SELECT * from `cart` ;");
		return $carts;
	}
}

?>