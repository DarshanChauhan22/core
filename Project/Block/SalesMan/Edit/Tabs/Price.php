<?php


Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_SalesMan_Edit_Tab');


class Block_SalesMan_Edit_Tabs_Price extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salesMan/edit/tabs/price.php');
	}

	public function getProducts()
	{
		$products = Ccc::getModel('Product')->fetchAll("SELECT * FROM `product`");
		$salesmanId = (int)Ccc::getFront()->getRequest()->getRequest('id');
		$percentage = Ccc::getModel('Salesman')->getAdapter()->fetchOne("SELECT `percentage` FROM `sales_man` WHERE `salesmanId` = {$salesmanId}");
		return ['products' => $products, 'percentage' => $percentage];
	}

	public function getPrices()
	{
		$customerId = (int)Ccc::getFront()->getRequest()->getRequest('customerId');
		$prices = Ccc::getModel('Customer_Price')->getAdapter()->fetchPair("SELECT `productId`,`customerPrice` FROM `customer_price` WHERE `customerId` = {$customerId}");
		//print_r("SELECT `productId`,`customerPrice` FROM `customer_price` WHERE `customerId` = {$customerId}"); die;
		return $prices;
	}
}



