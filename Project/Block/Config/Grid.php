<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Config_Grid extends Block_Core_Template
{
	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
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

