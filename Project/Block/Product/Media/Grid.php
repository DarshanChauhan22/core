<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Product_Media_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

	public function getMedias()
	{
		$id = $_GET['id'];
		$media = Ccc::getModel('Product_Media');
		$medias = $media->fetchAll("SELECT * FROM product_media WHERE productId = $id");
		return $medias;
	}
}

?>