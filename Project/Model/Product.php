<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Product extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{		
		
		$statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
					self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

		if(!$key)
		{
			return $statues;
		}

		if(array_key_exists($key , $statues))
		{
			return $statues[$key];
		}

		return self::STATUS_DEFAULT;
	}	

	public function saveCategories($categoryIds , $productId = null)
	{

		global $adapter;
		$query = "DELETE FROM category_product WHERE productId = {$this->productId}";
		$adapter->delete($query);

		if($productId)
		{
			foreach ($categoryIds as $categoryId) 
				{		
					$categoryProduct = Ccc::getModel('Category_Product');
					$categoryProduct->productId = $productId;
					$categoryProduct->categoryId = $categoryId;
					$categoryProduct->save();
				}

		}
		foreach ($categoryIds as $categoryId) 
		{		
			$categoryProduct = Ccc::getModel('Category_Product');
			$categoryProduct->productId = $this->productId;
			$categoryProduct->categoryId = $categoryId;
			$categoryProduct->save();
		}
	}
}


