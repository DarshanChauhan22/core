<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Order_Edit_Tab');

class Block_Order_Edit_Tabs_Order extends Block_Core_Edit_Tabs_Content

{
	public function __construct()
	{
		$this->setTemplate('view/order/edit/tabs/order.php');
	}

	public function getOrder()
	{
		return Ccc::getRegistry('order');
	}

}