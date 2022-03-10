<?php

Ccc::loadClass('Block_Core_Template');

class Block_Customer_Price_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/price/grid.php');
	}

	public function getProducts()
	{
		$products = Ccc::getModel('Product')->fetchAll("SELECT * FROM product");
		$salesmanId = (int)Ccc::getFront()->getRequest()->getRequest('id');
		$percentage = Ccc::getModel('salesman')->getAdapter()->fetchOne("SELECT percentage FROM sales_man WHERE salesmanId = {$salesmanId}");
		return ['products' => $products, 'percentage' => $percentage];
	}

	public function getPrices()
	{
		$customerId = (int)Ccc::getFront()->getRequest()->getRequest('customerId');
		$prices = Ccc::getModel('Customer_Price')->getAdapter()->fetchPair("SELECT productId,customerPrice FROM customer_price WHERE customerId = {$customerId}");
		return $prices;
	}
}


?>