<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Grid extends Block_Core_Template
{
	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('customerId') FROM `customer`");
		$this->getPager()->execute($totalCount,$page);

		$customer = Ccc::getModel('Customer');
		$customers = $customer->fetchAll("SELECT c.*,a.* from `customer` c join `address` a on a.customerId = c.customerId AND a.billing = 1 LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $customers;
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

?>