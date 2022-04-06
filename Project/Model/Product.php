<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Product extends Model_Core_Row
{
	protected $medias;
    protected $base;
    protected $thumb;
    protected $small;
    protected $gallery;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';

    const DISCOUNT_MODE_PER = 1;
    const DISCOUNT_MODE_PRICE = 2;
    const DISCOUNT_MODE_DEFAULT = 1;
    const DISCOUNT_MODE_PER_LBL = 'AS Percentage';
    const DISCOUNT_MODE_PRICE_LBL = 'As Price';

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
	}

    public function saveCategories($categoryIds , $productId = null)
    {

        global $adapter;
        $query = "DELETE FROM category_product WHERE productId = {$productId}";
        $adapter->delete($query);

            foreach ($categoryIds as $categoryId) 
                {   
                    $categoryProduct = Ccc::getModel('Category_Product');
                    $categoryProduct->productId = $productId;
                    $categoryProduct->categoryId = $categoryId;
                    $categoryProduct->save();
                }
        
        /*foreach ($categoryIds as $categoryId) 
        {       
            $categoryProduct = Ccc::getModel('Category_Product');
            $categoryProduct->productId = $productId;
            $categoryProduct->categoryId = $categoryId;
            $categoryProduct->save();
            print_r($productId); die;
        }*/
       return;
    }
    public function getStatus($key = null)
    {       
        
        $statues = [self::DISCOUNT_MODE_PER => self::STATUS_ENABLED_LBL,
                    self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

        if(!$key)
        {
            return $statues;
        }

        if(array_key_exists($key , $statues))
        {
            return $statues[$key];
        }

        return self::DISCOUNT_MODE_DEFAULT;
    }

    public function getDiscountMode($key = null)
    {       
        
        $discountModes = [self::DISCOUNT_MODE_PER => self::DISCOUNT_MODE_PER_LBL,
                    self::DISCOUNT_MODE_PRICE => self::DISCOUNT_MODE_PRICE_LBL];

        if(!$key)
        {
            return $discountModes;
        }

        if(array_key_exists($key , $discountModes))
        {
            return $discountModes[$key];
        }

        return self::STATUS_DEFAULT;
    }
    public function getMedias($reload = false)
    {
        $mediasModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $mediasModel;
        }

        if($this->medias && !$reload)
        { 
            return $this->medias;
        }
        $medias = $mediasModel->fetchAll("SELECT * from product_media where productId = $this->productId");

        if(!$medias)
        {
            return $mediasModel;
        }
        return $medias;
        $this->setMedias($medias);
    }

    public function setMedias(Model_Product_Media $medias)
    {
        $this->medias = $medias;
        return $this;
    }


    public function getBase($reload = false)
    {
        $baseModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $baseModel;
        }

        if($this->base && !$reload)
        { 
            return $this->base;
        }
        $base = $baseModel->fetchRow("SELECT * from product_media WHERE base = 1");
        if(!$base)
        {
            return $baseModel;
        }
        $this->setBase($base);
        return $base;
    }

    public function setBase(Model_Product_Media $base)
    {
        $this->base = $base;
        return $this;
    }


    public function getThumb($reload = false)
    {
        $thumbModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $thumbModel;
        }

        if($this->thumb && !$reload)
        { 
            return $this->thumb;
        }
        $thumb = $thumbModel->fetchRow("SELECT * from product_media WHERE thumb = 1");
        if(!$thumb)
        {
            return $thumbModel;
        }
        $this->setThumb($thumb);
        return $thumb;
    }

    public function setThumb(Model_Product_Media $thumb)
    {
        $this->thumb = $thumb;
        return $this;
    }


    public function getSmall($reload = false)
    {
        $smallModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $smallModel;
        }

        if($this->small && !$reload)
        { 
            return $this->small;
        }
        $small = $smallModel->fetchRow("SELECT * from product_media WHERE small = 1");
        if(!$small)
        {
            return $smallModel;
        }
        $this->setSmall($small);
        return $small;
    }

    public function setSmall(Model_Product_Media $small)
    {
        $this->small = $small;
        return $this;
    }


    public function getGallery($reload = false)
    {
        $galleryModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $galleryModel;
        }

        if($this->gallery && !$reload)
        { 
            return $this->gallery;
        }
        $gallery = $galleryModel->fetchRow("SELECT * from product_media WHERE gallery = 1");
        if(!$gallery)
        {
            return $galleryModel;
        }
        $this->setGallery($gallery);
        return $gallery;
    }

    public function setGallery(Model_Product_Media $gallery)
    {
        $this->gallery = $gallery;
        return $this;
    }
}


