<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Page_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
		parent::__construct();
	}

	public function getEditUrl($page)
	{
		return $this->getUrl('edit',null,['id'=>$page->pageId]);
	}
	
	public function getDeleteUrl($page)
	{
		return $this->getUrl('delete',null,['id'=>$page->pageId]);
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
			$this->getPages());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('pageId', [
			'title' => 'page Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('code',[
			'title' => 'Code',
			'type' => 'varchar',
		]);

		$this->addColumn('content',[
			'title' => 'Content',
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

		$this->addColumn('updatedAt',[
			'title' => 'UpdatedAt',
			'type' => 'datetime',
		]);

		return $this;
	}
	
	public function getPages()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('pageId') FROM `page`");
		$this->getPager()->execute($totalCount,$page);
		$pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $pages;
	}
	
}




	

	