<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit.php');
	}

	public function getCategory()
	{
		return $this->getData('category');
	}

	public function getCategoriePath()
	{	
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryToPath();
		return $categoryPath;
	}
}

?>