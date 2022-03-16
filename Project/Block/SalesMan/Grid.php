<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_salesman_Grid extends Block_Core_Template
{
	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getSalesmans()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('salesmanId') FROM `sales_man`");
		$this->getPager()->execute($totalCount,$page);

		$salesman = Ccc::getModel('salesman');
		$salesmans = $salesman->fetchAll("SELECT * FROM `sales_man` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $salesmans;
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