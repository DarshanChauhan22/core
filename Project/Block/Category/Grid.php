<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Category_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($category)
	{
		return $this->getUrl('edit',null,['id'=>$category->categoryId]);
	}
	
	public function getDeleteUrl($category)
	{
		return $this->getUrl('delete',null,['id'=>$category->categoryId]);
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
		$this->setCollections($this->getCategories());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('categoryId', [
			'title' => 'Category Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('baseImage',[
			'title' => 'Base Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('smallImage',[
			'title' => 'Small Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('thumbImage',[
			'title' => 'Thumb Image',
			'type' => 'tinyInt',
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

	public function getCategories()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('categoryId') FROM `category`");
		$this->getPager()->execute($totalCount,$page);




		$category = Ccc::getModel('Category');
		$categories = $category->fetchAll("SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM category p 
										LEFT JOIN category_media b ON p.categoryId = b.categoryId AND (b.base = 1)
										LEFT JOIN category_media t ON p.categoryId = t.categoryId AND (t.thumb = 1)
										LEFT JOIN category_media s ON p.categoryId = s.categoryId AND (s.small = 1) ORDER BY categoryPath LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $categories;
	}

	public function getCategorieWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$category = new Controller_Category();
		$categoryPath = $category->getCategoryToPath();
		return $categoryPath;
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