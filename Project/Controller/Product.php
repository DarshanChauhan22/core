<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');


class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Product_grid')->toHtml();
		/*
		global $adapter;
		$query = "SELECT * FROM Product";
		$product = $adapter-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('product',$product);
		$view->toHtml();
		//require_once('view/product/grid.php');
		*/
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
		/*
		$view = $this->getView();
		$view->setTemplate('view/product/add.php')->toHtml();
		//require_once('view/product/add.php');*/
	}

	public function editAction()
	{

		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$productModel = Ccc::getModel('Product');
			$product = $productModel->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
			if(!$product){
				throw new Exception("unable to load product.");
			}
			Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}


		/*try {
			$id = (int)$this->getRequest()->getRequest('id');
			if(!id){
				throw new Exception("invalid");
			}
			global $adapter;
		$request = new Model_Core_Request();
		$getId = $request->getRequest('id');
      	$pid=$getId;
     	$query = "SELECT * FROM Product WHERE productId=".$pid;
     	$product = $adapter->fetchRow($query);
     	$view = $this->getView();
		$view->setTemplate('view/product/edit.php');
		$view->addData('product',$product);
		$view->toHtml();*/
		
		//require_once('view/product/edit.php');
	}
		

	public function saveAction()
	{
		$customerTable = Ccc::getModel('Product');
		//$adminTable = new Model_Product(); 
		//$request = new Model_Core_Request();
		try {
			$row =  $this->getRequest()->getRequest('product');
			
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$productId = $row["productId"];
			global $adapter;
			global $date;
			//$request = new Model_Core_Request();
			//$row = $request->getPost('product');
			//$row = $_POST['product'];
			if (array_key_exists('productId', $row)) 
			{
				if(!(int)$row['productId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				/*$query = "UPDATE Product 
					SET name='".$row['name']."',
						price=".$row['price'].",
						quantity='".$row['quantity']."',
						updatedAt='".$date."',
						status='".$row['status']."' 
					Where productId='".$row['id']."'";	*/
				$update = $customerTable->update($row,['productId' => $productId]);

				
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
			
				/*$query = "INSERT INTO Product(name,price,quantity,status,createdAt) 
				VALUES('".$row['name']."',
					   '".$row['price']."',
					   '".$row['quantity']."',
					   '".$row['status']."',
					   '".$date."'
					   );";*/
				$insert=$customerTable->insert($row);
				
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect($this->getUrl('grid','product',null,true));
			
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function deleteAction()
	{
		$customerTable = Ccc::getModel('Product');
		try 
		{	
			$getId = $this->getRequest()->getRequest('id');
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			//global $adapter;
			//$query = "DELETE FROM Product WHERE productId = ".$getId;
			$delete = $customerTable->delete(['productId' => $getId]); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			$this->redirect($this->getUrl('grid','product',null,true));
		} catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function errorAction()
	{
		echo "error";
	}
}

?>