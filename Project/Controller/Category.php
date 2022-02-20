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
		$categoryModel = Ccc::getModel('category');      
	    $pid=(int) $this->getRequest()->getRequest('id');
	    $query = "SELECT 
	                  * 
	    FROM Category WHERE categoryId=".$pid;
	    $row = $categoryModel-> fetchRow($query);
		
	    $categoryPathPair = $categoryModel->fetchAll('SELECT categoryId,categoryPath FROM Category');
	    Ccc::getBlock('Category_Edit')->addData('category',$row)->toHtml();	
	   
	}

	public function saveAction()
	{
		try 
		{	$categoryTable = Ccc::getModel('Category');
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
				
					$query = ['name' => $row['name'] , 'updatedAt' => $date , 'parentId' => $row['parentId'], 'status' => $row['status']];

				$update = $categoryTable->update($query , ['categoryId' => $row['id']]);
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
					$query = ['name' => $row['name'] , 'createdAt' => $date , 'status' => $row['status']];

				}
				else
				{
					$query = ['name' => $row['name'] , 'createdAt' => $date , 'status' => $row['status'] , 'parentId' => $row['parentId']];
				}
				$insert=$categoryTable->insert($query);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$categoryTable->fetchRow("SELECT parentId FROM Category WHERE categoryId=".$insert);
				$parent = array_shift($parent);
				
				if ($parent == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$categoryTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parent);
					
					$path = $result['categoryPath'].'/'.$insert;

				}
				$query = ['categoryPath' => $path , 'status' => $row['status']];

				$update = $categoryTable->update($query , ['categoryId' => $insert]);
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
		$categoryTable = new Model_Category(); 
		$category=$categoryTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
		$categoryPath=$categoryTable->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category['categoryPath'].'/%'."' ORDER BY categoryPath");
		if($parentId == 'NULL')
		{	
			$query = [
                    "parentId" => null,
                    "categoryPath" => $categoryId];
		}
		else
		{
			$parent=$categoryTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
			$parent = $parent['categoryPath'].'/'.$categoryId;
			$query = [
                    "parentId" => $parentId,
                    "categoryPath" => $parent];
		}
		$update = $categoryTable->update($query , ['categoryId' => $categoryId]);
		if(!$update)
		{
			echo "error";
			exit;
			throw new Exception("System is unable to update.", 1);
		}	
		foreach ($categoryPath as $row) 
		{
			$parent=$categoryTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

			$query = [
                    "categoryPath" => $newPath,
                    "updatedAt" => $date];
			$update = $categoryTable->update($query , ['categoryId' => $row['categoryId']]);
			if(!$update)
			{
				throw new Exception("System is unable to update.", 1);
			}	

		}
		$this->redirect("index.php?c=category&a=grid");
	}


	public function deleteAction()
	{
		try 
		{
			$categoryTable = Ccc::getModel('Category');
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			//$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $categoryTable->delete(['categoryId' => $id]); 
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
        $categoryName=$adapter->fetchPair('SELECT categoryId,name FROM Category');
        
        $categoryPath=$adapter->fetchPair('SELECT categoryId,categoryPath FROM Category');
     
        $categories=[];
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