<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Media_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}

	public function getMedias()
	{
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$media = Ccc::getModel('Category_Media');
		$medias = $media->fetchAll("SELECT * FROM category_media WHERE categoryId = $id");
		return $medias;
	}
}

?>