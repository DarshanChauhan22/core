<?php Ccc::loadClass('Block_Core_Template');?>
<?php

class Block_Admin_Grid extends Block_Core_Template
{

	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
	}

	public function getAdmins()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('adminId') FROM `admin`");
		$this->getPager()->execute($totalCount,$page);

		$admin = Ccc::getModel('Admin');
		$admins = $admin->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $admins;
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