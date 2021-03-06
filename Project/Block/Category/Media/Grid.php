<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Category_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/media.php');
	}

	public function getMedias()
	{
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$media = Ccc::getModel('Category_Media');
		$medias = $media->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = {$id}");
		return $medias;
	}
}

?>