<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Media_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}


	/* public function getProductMedias()
   {	
   		$id = $_GET['id'];
   		$productMedia = Ccc::getModel('Product_Media');
		$productMedias = $productMedia->fetchAll("SELECT * FROM product_media WHERE productId = $id");
		return $productMedias;
   }*/
	public function getMedias()
	{
		$id = $_GET['id'];
		$media = Ccc::getModel('Category_Media');
		$medias = $media->fetchAll("SELECT * FROM category_media WHERE categoryId = $id");
		return $medias;
	}
}

?>