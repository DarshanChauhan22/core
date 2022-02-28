<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$category = Ccc::getModel('Category');
		$categories = $category->fetchAll("SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM category p 
										LEFT JOIN category_media b ON p.categoryId = b.categoryId AND (b.base = 1)
										LEFT JOIN category_media t ON p.categoryId = t.categoryId AND (t.thumb = 1)
										LEFT JOIN category_media s ON p.categoryId = s.categoryId AND (s.small = 1) ORDER BY categoryPath;");
		return $categories;
	}

	public function getCategoriePath()
	{
		Ccc::loadClass('Controller_Category');
		$category = new Controller_Category();
		//$categoryModel = Ccc::getModel('category');
		$categoryPath = $category->getCategoryToPath();
		return $categoryPath;
	}

}

?>