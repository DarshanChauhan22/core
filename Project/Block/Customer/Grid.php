<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Customer_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit',null,['id'=>$customer->customerId]);
	}
	
	public function getDeleteUrl($customer)
	{
		return $this->getUrl('delete',null,['id'=>$customer->customerId]);
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
		$this->setCollections($this->getcustomers());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('customerId', [
			'title' => 'customer Id',
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
			'title' => 'mobile',
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

	protected $pager;
	
	public function getCustomers()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
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