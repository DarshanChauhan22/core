<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_ShippingMethod_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/grid.php');
		parent::__construct();
	}

	public function getEditUrl($shippingMethod)
	{
		return $this->getUrl('edit',null,['id'=>$shippingMethod->shippingMethodId]);
	}
	
	public function getDeleteUrl($shippingMethod)
	{
		return $this->getUrl('delete',null,['id'=>$shippingMethod->shippingMethodId]);
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
			$this->getShippingMethods());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('methodId', [
			'title' => 'Method Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('note',[
			'title' => 'Note',
			'type' => 'text',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('price',[
			'title' => 'Price',
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
	
	public function getShippingMethods()
	{
		$admin = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		$totalCount = $paymentMethodModel->getAdapter()->fetchOne("SELECT count('methodId') FROM `shippingMethod`");
		$this->getPager()->execute($totalCount,$admin);
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		$shippingMethods = $shippingMethodModel->fetchAll("SELECT * FROM `shippingMethod` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $shippingMethods;
	}
	
}

	
	

	