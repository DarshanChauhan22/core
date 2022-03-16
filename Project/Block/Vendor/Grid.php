<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Vendor_Grid extends Block_Core_Template
{

	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendors()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('vendorId') FROM `vendor`");
		$this->getPager()->execute($totalCount,$page);

		$vendor = Ccc::getModel('Vendor');
		$vendors = $vendor->fetchAll("SELECT c.*,a.* from vendor c join vendor_address a on a.vendorId = c.vendorId LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $vendors;
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