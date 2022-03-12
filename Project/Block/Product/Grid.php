<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{
		$product = Ccc::getModel('Product');
		$products = $product->fetchAll("SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM product p 
										LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1)
										LEFT JOIN product_media t ON p.productId = t.productId AND (t.thumb = 1)
										LEFT JOIN product_media s ON p.productId = s.productId AND (s.small = 1);");
		return $products;
	}
}

?>