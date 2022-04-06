<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_PaymentMethod_Edit_Tab');

class Block_PaymentMethod_Edit_Tabs_PaymentMethod extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/paymentMethod/edit/tabs/PaymentMethod.php');
	}

	public function getPaymentMethod()
	{
		return Ccc::getRegistry('paymentMethod');
	}
}