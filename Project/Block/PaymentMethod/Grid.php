<?php 

Ccc::loadClass('Block_Core_Template');
class Block_PaymentMethod_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/paymentMethod/grid.php');
	}

	public function getPaymentMethods()
	{
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		$paymentMethods = $paymentMethodModel->fetchAll("SELECT * FROM `paymentMethod`;");
		return $paymentMethods;
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
