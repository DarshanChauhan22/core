<?php 

Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Customer_Edit_Tab');
class Block_Customer_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getCustomer()
	{
		return $this->getData('customer');
	}

	public function getBillingAddress()
	{
		return $this->getData('billingAddress');
	}

	public function getShippingAddress()
	{
		return $this->getData('shippingAddress');
	}

	public function getSaveUrl()
	{
		return $this->getUrl('save',null,['tab' => null]);
	}

}