<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');

class Controller_Category extends Controller_Core_Action {
	public function gridAction()
	{
		Ccc::getBlock('Category_grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
	}

	public function editAction()
	{
	    $pid=(int) $this->getRequest()->getRequest('id');
		$category = Ccc::getModel('category')->load($pid);      
	    $query = "SELECT 
	                  * 
	    FROM Category WHERE categoryId=".$pid;
	    $row = $category->fetchRow($query);
		
	    $categoryPathPair = $category->fetchAll('SELECT categoryId,categoryPath FROM Category');
	    Ccc::getBlock('Category_Edit')->addData('category',$row)->toHtml();	
	   
	}

	public function saveAction()
	{
		try 
		{	//$categoryModel = Ccc::getModel('Category_Resource');
		$category = Ccc::getModel('Category');

       		//$category = $category->getRow();
			$row = $this->getRequest()->getRequest('category');
			
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			global $date;
			
			$path = '';
			
			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$category->load($row['id']);
                $category->name = $row['name'];
                $category->parentId =  $row['parentId'];
                $category->status =  $row['status'];
                $category->updatedAt =  $date;
                $update = $category=$category->save();

				
					/*$query = ['name' => $row['name'] , 'updatedAt' => $date , 'parentId' => $row['parentId'], 'status' => $row['status']];

				$update = $categoryModel->update($query , ['categoryId' => $row['id']]);*/
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}
				$result = $this->updatePathIntoCategory($row['id'],$row['parentId']);
				
			}
			else
			{
				if ($row['parentId'] == 'NULL') 
				{
			    $category->name = $row['name'];
                $category->status =  $row['status'];
                $insert=$category->save();

					/*$query = ['name' => $row['name'] , 'createdAt' => $date , 'status' => $row['status']];*/

				}
				else
				{
				$category->name = $row['name'];
                $category->status =  $row['status'];
                $category->parentId =  $row['parentId'];
                $insert= $category->save();

					/*$query = ['name' => $row['name'] , 'createdAt' => $date , 'status' => $row['status'] , 'parentId' => $row['parentId']];*/
				}
				//$insert=$categoryModel->insert($query);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$category->fetchRow("SELECT parentId FROM Category WHERE categoryId=".$insert);
				$parent = array_shift($parent);
				
				if ($parent == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parent);
					
					$path = $result['categoryPath'].'/'.$insert;

				}
				echo "1";
				exit();
				$category->load($insert);
                $category->categoryPath = $path;
                $category->status =  $row['status'];
                $update=$category->save();
				/*$query = ['categoryPath' => $path , 'status' => $row['status']];

				$update = $categoryModel->update($query , ['categoryId' => $insert]);*/
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}				
			}
		$this->redirect($this->getUrl('grid','category',null,true));
		
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','category',null,true));	
		}
	}
	
	public function updatePathIntoCategory($categoryId,$parentId)
	{
		global $date;
		//$categoryModel = new Model_Category(); 
		$category = Ccc::getModel('Category');
		$category=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
		$categoryPath=$category->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category['categoryPath'].'/%'."' ORDER BY categoryPath");
		if($parentId == 'NULL')
		{	
				$category->load($categoryId);
                $category->parentId = null;
                $category->categoryPath = $categoryId;
                $update=$category->save();
			/*$query = [
                    "parentId" => null,
                    "categoryPath" => $categoryId];*/
		}
		else
		{
			$parent=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
			$parent = $parent['categoryPath'].'/'.$categoryId;
			
				$category->load($categoryId);
                $category->parentId = $parentId;
                $category->categoryPath = $parent;
                $update=$category->save();
			/*$query = [
                    "parentId" => $parentId,
                    "categoryPath" => $parent];*/
		}
		//$update = $categoryModel->update($query , ['categoryId' => $categoryId]);
		if(!$update)
		{
			echo "error";
			exit;
			throw new Exception("System is unable to update.", 1);
		}	
		foreach ($categoryPath as $row) 
		{
			$parent=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

				$category = $category->load($row['categoryId']);
                $category->categoryPath = $newPath;
                $category->updatedAt = $date;
                $update=$category->save();
			
			/*$query = [
                    "categoryPath" => $newPath,
                    "updatedAt" => $date];*/
			//$update = $categoryModel->update($query , ['categoryId' => $row['categoryId']]);
			if(!$update)
			{
				throw new Exception("System is unable to update.", 1);
			}	

		}
		$this->redirect($this->getUrl('grid','category',null,true));
	}


	public function deleteAction()
	{
		try 
		{
			$categoryModel = Ccc::getModel('Category_Resource');
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			//$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $categoryModel->delete(['categoryId' => $id]); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
				
			}
			$this->redirect($this->getUrl('grid','category',null,true));		
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','category',null,true));		
		}
			
	}

	public function errorAction()
	{
		echo "error";
	}
	public function taskAction()
	{	
		global $adapter;
		$result=$adapter->fetchOne('SELECT categoryPath FROM Category where categoryId = 149');
	}

	public function getCategoryToPath()
    {		
    	global $adapter;
    	$categories=[];
        $categoryName=$adapter->fetchPair('SELECT categoryId,name FROM category');
        if (!$this->getRequest()->getRequest('CategoryId')) 
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
        //$categoryPath=$adapter->fetchPair('SELECT categoryId,categoryPath FROM Category');
     
        
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

?>