<?php 

Ccc::loadClass('Block_Core_Edit_Tab');

class Block_PaymentMethod_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('paymentMethod');
	}

	public function prepareTabs()
	{ 
		$this->addTab(
			[
			'title' => 'PaymentMethod Information',
			'block' => 'PaymentMethod_Edit_Tabs_PaymentMethod',
			'url' => $this->getUrl(null,null,['tab' => 'paymentMethod'])],'paymentMethod');	
		
		return $this;
	}

}