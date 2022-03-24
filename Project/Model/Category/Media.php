<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Category_Media extends Model_Core_Row
{
	protected $category; 
    protected $mediaPath = "Media/category"; 
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		parent::__construct();
	}


	public function getCategory($reload = false)
    {
        $categoryModel = Ccc::getModel('Category');
        
        if(!$this->categoryId)
        {
            return $categoryModel;
        }

        if($this->category && !$reload)
        { 
            return $this->category;
        }
        $category = $categoryModel->fetchRow("SELECT * from category WHERE categoryId = {$this->categoryId}");
        if(!$category)
        {
            return $categoryModel;
        }
        $this->setCategory($category);
        return $category;
    }

    public function setCategory(Model_Category $category)
    {
        $this->category = $category;
        return $this;
    }

     public function getImageUrl()
    {     
        return Ccc::getBaseUrl($this->mediaPath.'/'.$this->image);
    }

    public function getImagePath()
    {     
        return Ccc::getBasePath($this->mediaPath.'/'.$this->image);
    }
}


