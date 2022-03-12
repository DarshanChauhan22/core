<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

	public function getMedias()
	{
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$media = Ccc::getModel('Product_Media');
		$medias = $media->fetchAll("SELECT * FROM product_media WHERE productId = $id");
		return $medias;
	}
}

?>