<?php 

Ccc::loadClass('Block_Core_Template');
class Block_salesman_Edit extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/salesman/edit.php');
	}
	public function getsalesman()
	{
		return $this->getData('salesman');
	}
}

?>