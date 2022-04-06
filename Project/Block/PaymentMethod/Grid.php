<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_PaymentMethod_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		$this->setTemplate('view/paymentMethod/grid.php');
		parent::__construct();
	}

	public function getEditUrl($paymentMethod)
	{
		return $this->getUrl('edit',null,['id'=>$paymentMethod->paymentMethodId]);
	}
	
	public function getDeleteUrl($paymentMethod)
	{
		return $this->getUrl('delete',null,['id'=>$paymentMethod->paymentMethodId]);
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
			$this->getPaymentMethods());
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
	
	public function getPaymentMethods()
	{
		$admin = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		$totalCount = $paymentMethodModel->getAdapter()->fetchOne("SELECT count('methodId') FROM `paymentMethod`");
		$this->getPager()->execute($totalCount,$admin);
		$paymentMethods = $paymentMethodModel->fetchAll("SELECT * FROM `paymentMethod`LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $paymentMethods;
	}

	
}

	