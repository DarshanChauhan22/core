<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$categoryModel = Ccc::getModel('category');
		$categories = $categoryModel->fetchAll("SELECT * FROM category order by categoryPath asc");
		return $categories;
	}

	public function getCategoriePath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		//$categoryModel = Ccc::getModel('category');
		$categoryPath = $categoryModel->getCategoryToPath();
		return $categoryPath;
	}

}

?>