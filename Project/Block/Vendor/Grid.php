<?php Ccc::loadClass('Block_Core_Grid_Collection'); ?>

<?php 
class Block_Vendor_Grid extends Block_Core_Grid_Collection
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
		parent::__construct();
	}

	public function getEditUrl($vendor)
	{
		return $this->getUrl('edit',null,['id'=>$vendor->vendorId]);
	}
	
	public function getDeleteUrl($vendor)
	{
		return $this->getUrl('delete',null,['id'=>$vendor->vendorId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			],'actions');
		return $this;
	}

	public function prepareCollections()
	{
		$this->addCollection([
			$this->getVendors()
		],'collection');
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('vendorId', [
			'title' => 'Vendor Id',
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

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);
		$this->addColumn('address',[
			'title' => 'Address',
			'type' => 'varchar',
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
		$vendors = $vendor->fetchAll("SELECT c.vendorId,c.firstName,c.lastName,c.email,c.mobile,c.status,a.address,c.createdAt,c.updatedAt from vendor c join vendor_address a on a.vendorId = c.vendorId LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $vendors;
	}
}

?>