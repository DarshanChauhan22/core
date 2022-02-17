<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Core_Request');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		global $adapter;
		$query = "SELECT * FROM Product";
		$product = $adapter-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('product',$product);
		$view->toHtml();
		//require_once('view/product/grid.php');
		
	}

	public function addAction()
	{
		
		$view = $this->getView();
		$view->setTemplate('view/product/add.php')->toHtml();
		//require_once('view/product/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$request = new Model_Core_Request();
		$getId = $request->getRequest('id');
      	$pid=$getId;
     	$query = "SELECT * FROM Product WHERE productId=".$pid;
     	$product = $adapter->fetchRow($query);
     	$view = $this->getView();
		$view->setTemplate('view/product/edit.php');
		$view->addData('product',$product);
		$view->toHtml();
		
		//require_once('view/product/edit.php');
	}

	public function saveAction()
	{
		$request = new Model_Core_Request();
		try {
			$row = $request->getPost('product');
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			global $date;
			//$request = new Model_Core_Request();
			//$row = $request->getPost('product');
			//$row = $_POST['product'];
			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$query = "UPDATE Product 
					SET name='".$row['name']."',
						price=".$row['price'].",
						quantity='".$row['quantity']."',
						updatedAt='".$date."',
						status='".$row['status']."' 
					Where productId='".$row['id']."'";	
				$update = $adapter->update($query);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
				$query = "INSERT INTO Product(name,price,quantity,status,createdAt) 
				VALUES('".$row['name']."',
					   '".$row['price']."',
					   '".$row['quantity']."',
					   '".$row['status']."',
					   '".$date."'
					   );";
				$insert=$adapter->insert($query);
				var_dump($insert);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect("index.php?c=product&a=grid");
			
		} catch (Exception $e) {
			$this->redirect("index.php?c=product&a=grid");
		}
	}

	public function deleteAction()
	{
		$request = new Model_Core_Request();
		try 
		{
			$getId = Ccc::getFront()->getRequest('id'); 
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			global $adapter;
			$request = new Model_Core_Request();
			//$getId = $request->getRequest('id');
			//$id=$getId;
			$query = "DELETE FROM Product WHERE productId = ".$getId;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->redirect("index.php?c=product&a=grid");
		} catch (Exception $e) 
		{
			$this->redirect("index.php?c=product&a=grid");
		}
	}

	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}

	public function errorAction()
	{
		echo "error";
	}
}

?>