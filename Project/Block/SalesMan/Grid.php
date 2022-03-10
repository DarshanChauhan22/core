<?php 

Ccc::loadClass('Block_Core_Template');
class Block_salesman_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getsalesmans()
	{
		$salesman = Ccc::getModel('salesman');
		$salesmans = $salesman->fetchAll("SELECT * FROM sales_man");
		return $salesmans;
	}
}

?>