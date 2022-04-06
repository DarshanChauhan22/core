<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Config_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
		parent::__construct();
	}

	public function getEditUrl($config)
	{
		return $this->getUrl('edit',null,['id'=>$config->configId]);
	}
	
	public function getDeleteUrl($config)
	{
		return $this->getUrl('delete',null,['id'=>$config->configId]);
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
			$this->getConfigs());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('configId', [
			'title' => 'config Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('value',[
			'title' => 'Value',
			'type' => 'varchar',
		]);

		$this->addColumn('code',[
			'title' => 'Code',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);
		return $this;
	}
	
	public function getConfigs()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		
		//$pageModel = Ccc::getModel('Page');
		$this->setPager($pager);
		$config = Ccc::getModel('Config');
		$totalCount = $config->getAdapter()->fetchOne("SELECT count('configId') FROM `config`");
		//print_r($page); die;
		$this->getPager()->execute($totalCount,$page);


		$configs = $config->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $configs;
	}
}

	















	

	