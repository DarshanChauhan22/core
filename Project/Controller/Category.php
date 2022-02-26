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
		$category = Ccc::getModel('category');
		Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();	
	   
		//Ccc::getBlock('Category_Add')->toHtml();
	}

	public function editAction()
	{

	    $pid=(int) $this->getRequest()->getRequest('id');
		$category = Ccc::getModel('category')->load($pid);;      
	    $query = "SELECT 
	                  * 
	    FROM Category WHERE categoryId=".$pid;
	    $row = $category-> fetchRow($query);
		
	    $categoryPathPair = $category->fetchAll('SELECT categoryId,categoryPath FROM Category');
	    Ccc::getBlock('Category_Edit')->addData('category',$row)->toHtml();	
	   
	}

	public function saveAction()
	{
		try 
		{	//$category = Ccc::getModel('category');
		//$pid=(int) $this->getRequest()->getRequest('id');
		$category = Ccc::getModel('category');
		

       		//$category = $category->getRow();
			$row = $this->getRequest()->getRequest('category');
			$parentId = $row['parentId'];
			
			
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			
			$path = '';
			
			if (array_key_exists('id', $row) && $row['id'] != null) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$category = $category->load($row['id']);
                $category->name = $row['name'];
                $category->parentId =  $row['parentId'];
                $category->status =  $row['status'];
                $category->updatedAt =  $date;
                $update = $category=$category->save();

				
					/*$query = ['name' => $row['name'] , 'updatedAt' => $date , 'parentId' => $row['parentId'], 'status' => $row['status']];

				$update = $category->update($query , ['categoryId' => $row['id']]);*/
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
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
				//$insert=$category->insert($query);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$category->fetchRow("SELECT parentId FROM Category WHERE categoryId=".$insert);
				//$parent = array_shift($parent);
				
				//$parentId = $this->getRequest()->getRequest('parentId');
				//$arr = array($parent);
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
				/*$query = ['categoryPath' => $path , 'status' => $row['status']];

				$update = $category->update($query , ['categoryId' => $insert]);*/
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
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		$row = $this->getRequest()->getRequest('category');
		
		//$category = new Model_Category(); 
		$category = Ccc::getModel('category');
		$categoryRow=$category->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
		
		//print_r($category);

		$res = $categoryRow->getData();
		$categoryRow = $res['categoryPath'];

		//print_r($category);
		//print_r("SELECT * FROM Category WHERE categoryPath LIKE '".$category.'/%'."' ORDER BY categoryPath");


		$query = "LIKE '$categoryRow%' ORDER BY categoryPath";
		
		//print_r("SELECT * FROM Category WHERE categoryPath $query");
		
		
		$categoryPath=$category->fetchAll("SELECT * FROM Category WHERE categoryPath $query");
		
		if($parentId == 'NULL')
		{	
			
				$category = $category->load($categoryId);
                $category->parentId = null;
                $category->categoryPath = $categoryId;
                $update=$category->save();

			/*$query = [
                    "parentId" => null,
                    "categoryPath" => $categoryId];*/
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
			/*$query = [
                    "parentId" => $parentId,
                    "categoryPath" => $parent];*/
		}
		//$update = $category->update($query , ['categoryId' => $categoryId]);
		if(!$update)
		{
			echo "error";
			exit;
			throw new Exception("System is unable to update.", 1);
		}	

		//$categoryPath = $category->fetchRow("SELECT * FROM Category WHERE categoryPath .$query");
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
			
			/*$query = [
                    "categoryPath" => $newPath,
                    "updatedAt" => $date];*/
			//$update = $category->update($query , ['categoryId' => $row['categoryId']]);
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
			$category = Ccc::getModel('Category_Resource');
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			//$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $category->delete(['categoryId' => $id]); 
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
		$adapter = $this->getAdapter();
		$result=$adapter->fetchOne('SELECT categoryPath FROM Category where categoryId = 149');
	}

	public function getCategoryToPath()
    {		
    	$adapter = $this->getAdapter();
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