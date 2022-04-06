<?php 

Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Order_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('order');
	}

	public function prepareTabs()
	{ 
		$this->addTab(
			[
			'title' => 'Order Information',
			'block' => 'Order_Edit_Tabs_Order',
			'url' => $this->getUrl(null,null,['tab' => 'order'])],'order');	
		
		return $this;
	}

}