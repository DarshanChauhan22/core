<?php 

Ccc::loadClass('Block_Core_Template');
class Block_SalesMan_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/salesMan/grid.php');
	}

	public function getSalesMans()
	{
		$salesMan = Ccc::getModel('salesMan');
		$salesMans = $salesMan->fetchAll("SELECT * FROM sales_man");
		return $salesMans;
	}
}

?>