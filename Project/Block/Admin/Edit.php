<?php 

Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Admin_Edit_Tab');
class Block_Admin_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAdmin()
	{
		return $this->getData('admin');
	}

	public function getSaveUrl()
	{
		return $this->getUrl('save',null,['tab' => null]);
	}

}