<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Page_Edit_Tab');

class Block_Page_Edit_Tabs_page extends Block_Core_Edit_Tabs_Content

{
	public function __construct()
	{
		$this->setTemplate('view/page/edit/tabs/page.php');
	}

	public function getpage()
	{
		return Ccc::getRegistry('page');
	}

}