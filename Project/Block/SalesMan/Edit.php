<?php 

Ccc::loadClass('Block_Core_Template');
class Block_SalesMan_Edit extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/salesMan/edit.php');
	}
	public function getSalesMan()
	{
		return $this->getData('salesMan');
	}
}

?>