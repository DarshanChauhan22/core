<?php 

Ccc::loadClass('Block_Core_Edit_Tab');

class Block_ShippingMethod_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('shippingMethod');
	}

	public function prepareTabs()
	{ 
		$this->addTab(
			[
			'title' => 'ShippingMethod Information',
			'block' => 'ShippingMethod_Edit_Tabs_ShippingMethod',
			'url' => $this->getUrl(null,null,['tab' => 'shippingMethod'])],'shippingMethod');	
		
		return $this;
	}

}