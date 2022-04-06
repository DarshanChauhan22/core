<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Product_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($product)
	{
		return $this->getUrl('edit',null,['id'=>$product->productId]);
	}
	
	public function getDeleteUrl($product)
	{
		return $this->getUrl('delete',null,['id'=>$product->productId]);
	}
	public function prepareActions()
	{
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getProducts());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('productId', [
			'title' => 'Product Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('baseImage',[
			'title' => 'Base Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('smallImage',[
			'title' => 'Small Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('thumbImage',[
			'title' => 'Thumb Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('sku',[
			'title' => 'Sku',
			'type' => 'int',
		]);

		$this->addColumn('price',[
			'title' => 'Price',
			'type' => 'int',
		]);

		$this->addColumn('cost',[
			'title' => 'Cost',
			'type' => 'float',
		]);

		$this->addColumn('quantity',[
			'title' => 'Quantity',
			'type' => 'int',
		]);

		$this->addColumn('tax',[
			'title' => 'Tax',
			'type' => 'decimal',
		]);

		$this->addColumn('discountMode',[
			'title' => 'Discount Mode',
			'type' => 'tinyInt',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'UpdatedAt',
			'type' => 'datetime',
		]);

		return $this;
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