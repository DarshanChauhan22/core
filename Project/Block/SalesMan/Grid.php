<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_SalesMan_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		$this->setTemplate('view/salesMan/grid.php');
		parent::__construct();
	}

	public function getEditUrl($salesMan)
	{
		return $this->getUrl('edit',null,['id'=>$salesMan->salesManId]);
	}

	public function getDeleteUrl($salesMan)
	{
		return $this->getUrl('delete',null,['id'=>$salesMan->salesManId]);
	}
	public function prepareActions()
	{
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections(
			$this->getSalesmans());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('salesmanId', [
			'title' => 'salesMan Id',
			'type' => 'int',
		]);

		$this->addColumn('firstName',[
			'title' => 'First Name',
			'type' => 'varchar',
		]);

		$this->addColumn('lastName',[
			'title' => 'Last Name',
			'type' => 'varchar',
		]);

		$this->addColumn('email',[
			'title' => 'Email',
			'type' => 'varchar',
		]);

		$this->addColumn('mobile',[
			'title' => 'Mobile',
			'type' => 'varchar',
		]);

		$this->addColumn('percentage',[
			'title' => 'Percentage',
			'type' => 'float',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'UpdatedAt',
			'type' => 'datetime',
		]);

		return $this;
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

}

?>