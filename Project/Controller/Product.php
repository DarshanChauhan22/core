<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');


class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Product_grid')->toHtml();
	}

	public function addAction()
	{
		$product = Ccc::getModel('Product');
		Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();
		//Ccc::getBlock('Product_Add')->toHtml();
	}

	public function editAction()
	{

		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$productModel = Ccc::getModel('Product')->load($id);
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

	}
		

	public function saveAction()
	{
		//$customerTable = Ccc::getModel('Product_Resource');
		try {
			//$productModel = Ccc::getModel('Product_Resource');
			$product = Ccc::getModel('Product');
       		//$product = $productModel->getRow();
			$row =  $this->getRequest()->getRequest('product');
			
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$productId = $row["productId"];
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");

			 if(array_key_exists('productId',$row) && $row[productId] == null)
       		 {
                $product->name = $row['name'];
                $product->price =  $row['price'];
                $product->quantity =  $row['quantity'];
                $product->status =  $row['status'];
                $product->save();
        	}
        	else
        	{
        		$product->load($row['productId']);
        		$product->productId = $row["productId"];
                $product->name = $row['name'];
                $product->price =  $row['price'];
                $product->quantity =  $row['quantity'];
                $product->status =  $row['status'];
                $product->updatedAt =  $date;
                $product->save();
       			}



			/*if (array_key_exists('productId', $row)) 
			{
				if(!(int)$row['productId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$query = [
                    "name" => $row['name'],
                    "price" => $row['price'],
                    "quantity" => $row['quantity'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

				$update = $customerTable->update($query,['productId' => $productId]);

				
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
			
				$insert=$customerTable->insert($row);
				
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}*/
			$this->redirect($this->getUrl('grid','product',null,true));
			
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function deleteAction()
	{
		$customerTable = Ccc::getModel('Product_Resource');
		try 
		{	
			$getId = $this->getRequest()->getRequest('id');
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
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