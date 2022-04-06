<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_SalesMan_Edit_Tab');

class Block_SalesMan_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salesMan/edit/tabs/personal.php');
	}

	public function getSalesMan()
	{
		return Ccc::getRegistry('salesMan');
	}

}