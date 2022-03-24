<?php 

Ccc::loadClass('Block_Core_Template');
class Block_ShippingMethod_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/grid.php');
	}

	public function getShippingMethods()
	{
		
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		$shippingMethods = $shippingMethodModel->fetchAll("SELECT * FROM `shippingMethod`;");
		return $shippingMethods;
	}

	public function getPager()
	{
		return $this->pager;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this->pager;
	}
}
