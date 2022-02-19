<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');

class Controller_Category extends Controller_Core_Action {
	public function gridAction()
	{
		Ccc::getBlock('Category_grid')->toHtml();
		
		/*global $adapter; 
		$query = "SELECT 
					* 
				FROM Category order by categoryPath";
		$result = $adapter->fetchAll($query);	
		$view = $this->getView();
		$view->setTemplate('view/category/grid.php');
		$view->addData('category',$result);
		$categoryPath = $this->getCategoryToPath();
	    $view->addData('getCategoryToPath',$categoryPath);
 		$view->toHtml();
		//require_once('view/category/grid.php');*/
		
	}

	public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
		/*$view = $this->getView();
		$view->setTemplate('view/category/add.php');
		$categoryPath = $this->getCategoryToPath();
	    $view->addData('getCategoryToPath',$categoryPath);
 		$view->toHtml();
		//require_once('view/category/add.php');*/
	}

	public function editAction()
	{
		$categoryModel = Ccc::getModel('category');
		global $adapter;      
	    $pid=(int) $this->getRequest()->getRequest('id');
	    $query = "SELECT 
	                  * 
	    FROM Category WHERE categoryId=".$pid;
	    $row = $categoryModel-> fetchRow($query);
	
	 	//$view = $this->getView();
		
		//$view->setTemplate('view/category/edit.php');
		//$view->addData('category',$row);
		
	    $categoryPathPair = $categoryModel->fetchAll('SELECT categoryId,categoryPath FROM Category');
	    Ccc::getBlock('Category_Edit')->addData('category',$row)->toHtml();	
	    //$view->addData('categoryPathPair',$categoryPathPair);
 
	   // $categoryPath = $this->getCategoryToPath();
	   // $view->addData('categoryPath',$categoryPath);
 		//$view->toHtml();
 		//require_once('view/category/edit.php');
	}

	public function saveAction()
	{
		try 
		{	$adminTable = Ccc::getModel('Category');
			$row = $this->getRequest()->getRequest('category');
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			global $date;
			
			$path = '';

			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$query = ['name' => $row['name'] , 'updatedAt' => $date , 'status' => $row['status']];



				/*"UPDATE Category 
				SET name='".$row['name']."',
					updatedAt='".$date."',
					status='".$row['status']."'
				WHERE categoryId='".$row['id']."'";*/
				$update = $adminTable->update($query , ['categoryId' => $row['id']]);
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



                     /*
					"INSERT INTO Category(name,createdAt,status) 
					VALUES('".$row['name']."',
						   '".$date."',
						   '".$row['status']."')";
                     */

				}
				else
				{
					$query = ['name' => $row['name'] , 'createdAt' => $date , 'status' => $row['status'] , 'parentId' => $row['parentId']];


                    /*
					"INSERT INTO Category(name,createdAt,status,parentId) 
					VALUES('".$row['name']."',
							'".$date."',
							'".$row['status']."',
							'".$row['parentId']."')";*/
				}
				$insert=$adminTable->insert($query);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$adminTable->fetchRow("SELECT parentId FROM Category WHERE categoryId=".$insert);
				$parent = array_shift($parent);
				
				if ($parent == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$adminTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parent);
					
					$path = $result['categoryPath'].'/'.$insert;

				}
				$query = "UPDATE Category SET categoryPath = '".$path."' WHERE categoryId = ".$insert;
				$update = $adapter->update($query);
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
		$adminTable = Ccc::getModel('Category');
		global $adapter;
		global $date;

		$category=$adminTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
		$categoryPath=$adminTable->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category['categoryPath'].'/%'."' ORDER BY categoryPath");
		if($parentId == 'NULL')
		{	
			$query = "UPDATE Category 
			SET parentId=null, 
			categoryPath= $categoryId
			WHERE categoryId=$categoryId";
		}
		else
		{
			$parent=$adminTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
			$query = "UPDATE Category 
			SET parentId=".$parentId.", 
			categoryPath= '".$parent['categoryPath'].'/'.$categoryId."' 
			WHERE categoryId=".$categoryId;
		}
		$update = $adapter->update($query);
		if(!$update)
		{
			echo "error";
			exit;
			throw new Exception("System is unable to update.", 1);
		}	
		foreach ($categoryPath as $row) 
		{
			$parent=$adminTable->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

			$query = "UPDATE Category
				SET categoryPath = '".$newPath."',
					updatedAt = '".$date."'
					WHERE categoryId = ".$row['categoryId'];
			$update = $adapter->update($query);
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
			$adminTable = Ccc::getModel('Category');
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			global $adapter;
			
			//$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $adminTable->delete(['categoryId' => $id]); 
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