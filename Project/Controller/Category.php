<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Category'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Category extends Controller_Core_Action 
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock("Category_Grid");
        $content->addChild($categoryGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$category = Ccc::getModel('category');
		$content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock("Category_Edit")->setData(['category' => $category]);
        $content->addChild($categoryAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{
		try {
			$message = $this->getMessage();
	    $pid=(int) $this->getRequest()->getRequest('id');

	    if(!$pid)
		{
			throw new Exception("Id not valid.");
		}
		$category = Ccc::getModel('category')->load($pid);;   

		if(!$category)
		{	
			throw new Exception("unable to load admin.");
		}   
	    $query = "SELECT 
	                  * 
	    FROM Category WHERE categoryId=".$pid;
	    $row = $category-> fetchRow($query);
	
    	$categoryPathPair = $category->fetchAll('SELECT categoryId,categoryPath FROM Category');
   	    $content = $this->getLayout()->getContent();
        $categoryEdit = Ccc::getBlock("Category_Edit")->setData(['category' => $category]);
        $content->addChild($categoryEdit);
        $this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));		
		}
			
	}

	public function saveAction()
	{
		try 
		{
			$message = $this->getMessage();
			$category = Ccc::getModel('category');
		
			$row = $this->getRequest()->getRequest('category');
			$parentId = $row['parentId'];
			
			
			if (!$row) 
			{
				throw new Exception("Invalid Request.");				
			}
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			
			$path = '';
			
			if (array_key_exists('id', $row) && $row['id'] != null) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.");
				}
				
				$category = $category->load($row['id']);
                $category->name = $row['name'];
                $category->parentId =  $row['parentId'];
                $category->status =  $row['status'];
                $category->updatedAt =  $date;
                $update = $category=$category->save();

				if(!$update)
				{
					throw new Exception("System is unable to update.");
				}
				
				$result = $this->updatePathIntoCategory($row['id'],$parentId);
				
			}
			else
			{
				if ($row['parentId'] == 'NULL') 
				{
					
			    $category->name = $row['name'];
                $category->status =  $row['status'];
                $insert=$category->save();

				}
				else
				{
					
				$category->name = $row['name'];
                $category->status =  $row['status'];
                $category->parentId =  $row['parentId'];
                $insert= $category->save();

				}
				if(!$insert)
				{
					throw new Exception("System is unable to insert.");			
				}

				$parent=$category->fetchRow("SELECT parentId FROM Category WHERE categoryId=".$insert);
				$pid = $parent->getData();
				$parent = $pid['parentId'];
				
				
				if ($parent == 0) 
				{
					$path = $insert;
				}
				else
				{	
					$result=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parent);
					$res = $result->getData();
					$result = $res['categoryPath'];
					$path = $result.'/'.$insert;
				}

				$category = $category->load($insert);
                $category->categoryPath = $path;
                $category->status =  $row['status'];
                $update=$category->save();
				
				if(!$update)
				{
					throw new Exception("System is unable to update.");
				}				
			}
			$message->addMessage('Insert Successfully.');
		$this->redirect($this->getUrl('grid','category',null,true));
		
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));		
		}
	}
	
	public function updatePathIntoCategory($categoryId,$parentId)
	{
		try {
			$message = $this->getMessage();
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			$row = $this->getRequest()->getRequest('category');
			
			$category = Ccc::getModel('category');
			$categoryRow=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
			

			$res = $categoryRow->getData();
			$categoryRow = $res['categoryPath'];

			$query = "LIKE '$categoryRow%' ORDER BY categoryPath";
			
			$categoryPath=$category->fetchAll("SELECT * FROM Category WHERE categoryPath $query");
			
			if($parentId == 'NULL')
			{	
				
				$category = $category->load($categoryId);
	            $category->parentId = null;
	            $category->categoryPath = $categoryId;
	            $update=$category->save();

			}
			else
			{

				$parent=$category->fetchRow("SELECT * FROM Category WHERE categoryId = $parentId");
				$res = $parent->getData();
				
				$parent = $res['categoryPath'];
				

				$parent = $parent.'/'.$categoryId;
				
					$category = $category->load($categoryId);
	                $category->parentId = $parentId;
	                $category->categoryPath = $parent;
	                $update=$category->save();

			}
			if(!$update)
			{
				throw new Exception("System is unable to update.");
			}	

			foreach ($categoryPath as $row) 
			{
				$res = $row->getData();
				$parentId = $res['parentId'];
				$categoryId = $res['categoryId'];

				if(!$parentId == null)
				{
				$parent=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
				
				$res = $parent->getData();
				$categoryPath = $res['categoryPath'];
				}

				$newPath = $categoryPath.'/'.$categoryId;

				$category = $category->load($categoryId);
                $category->categoryPath = $newPath;
                $category->updatedAt = $date;
                $update=$category->save();
				
				if(!$update)
				{
					throw new Exception("System is unable to update.");
				}	

			}
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getUrl('grid','category',null,true));
			} catch (Exception $e) 
			{
				$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));	
		    }
		
	}


	public function deleteAction()
	{
		$adapter = $this->getAdapter();
		try 
		{
			$message = $this->getMessage();
			$id = $this->getRequest()->getRequest('id');
			$category = Ccc::getModel('Category')->load($id);

			$query1 = "SELECT imageId,image FROM category c LEFT JOIN category_media cm ON c.categoryId = cm.categoryId  WHERE c.categoryId = $id;";
            $result1 = $adapter->fetchPair($query1);


			if (!$id) 
			{
				throw new Exception("Invalid Request.");
			}
			
			$delete = $category->delete(['categoryId' => $id]); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.");
			}

			foreach($result1 as $key => $value){
            if($delete)
            {
              unlink($this->getBaseUrl('Media/Category/') . $value);               }
            }
            $message->addMessage('Delete Successfully.');
			$this->redirect($this->getUrl('grid','category',null,true));		
		} catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));			
		}
			
	}

	public function taskAction()
	{	
		$adapter = $this->getAdapter();
		$result=$adapter->fetchOne('SELECT categoryPath FROM Category where categoryId = 149');
	}

	public function getCategoryToPath()
    {		
    	$adapter = $this->getAdapter();
    	$categories=[];
        $categoryName=$adapter->fetchPair('SELECT categoryId,name FROM category');
        if (!$this->getRequest()->getRequest('id')) 
        {

            $query = "SELECT categoryId, categoryPath FROM category ORDER BY categoryPath"; 
        }
        else 
        {
            $categoryId = $this->getRequest()->getRequest('id');
            $excludePath = $adapter->fetchOne("SELECT categoryPath FROM category WHERE categoryId = '$categoryId'");
            $excludePath = $excludePath . '/%';
            $query = "SELECT categoryId,categoryPath FROM category WHERE categoryId <> '$categoryId' AND categoryPath NOT LIKE('$excludePath') ORDER BY categoryPath";  
        }
        $categoryPath = $adapter->fetchPair($query);
     
        
        foreach ($categoryPath as $key => $value) 
        {
                $explodeArray=explode('/', $value);
             
       
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) 
                {
                    if(array_key_exists($value,$categoryName))
                    {
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        } 
        return $categories;
    }	
}

