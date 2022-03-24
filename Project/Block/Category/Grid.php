<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Grid extends Block_Core_Template
{
	protected $pager;
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
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

	public function getCategoriePath()
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