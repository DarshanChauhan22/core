<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Product_Grid extends Block_Core_Template
{
	protected $pager;
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{

		$page = Ccc::getFront()->getRequest()->getRequest('p');
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('productId') FROM `product`");
		$this->getPager()->execute($totalCount,$page);

		$product = Ccc::getModel('Product');
		$products = $product->fetchAll("SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM product p 
										LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1)
										LEFT JOIN product_media t ON p.productId = t.productId AND (t.thumb = 1)
										LEFT JOIN product_media s ON p.productId = s.productId AND (s.small = 1) LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};");
		return $products;
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