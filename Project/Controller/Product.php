<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');


class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock("Product_Grid");
        $content->addChild($productGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$product = Ccc::getModel('Product');
		$content = $this->getLayout()->getContent();
      $productAdd = Ccc::getBlock("Product_Edit")->addData("product", $product);
      $content->addChild($productAdd);
      $this->renderLayout();	
	}

	public function editAction()
	{

		try 
		{
			$message = Ccc::getModel('Core_Message');
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				$message->addMessage('Id not valid.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("Id not valid.");
			}
			$productModel = Ccc::getModel('Product')->load($id);
			$product = $productModel->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
			if(!$product)
			{
				$message->addMessage('Unable To Load Admin.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("unable to load product.");
			}
				$content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock("Product_Edit")->addData("product", $product);
            $content->addChild($productEdit);
            $this->renderLayout();		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}

	}
		

	public function saveAction()
	{
		try {
			$message = Ccc::getModel('Core_Message');
			$product = Ccc::getModel('Product');
			$row =  $this->getRequest()->getRequest('product');
			
			if (!isset($row)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid'));
				//throw new Exception("Invalid Request.", 1);				
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
                $result = $product->save();

                if(!$result)
                {
                	$message->addMessage('Insert Unsuccessfully.',Model_Core_Message::ERROR);
                	$this->redirect($this->getUrl('grid',null,null,true));
                }
					$message->addMessage('Insert Successfully.');
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
                $result = $product->save();

             if(!$result)
             {
				$message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
             }
				$message->addMessage('Update Successfully.');
       			}

			$this->redirect($this->getUrl('grid','product',null,true));
			
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = Ccc::getModel('Core_Message');
			$adapter = $this->getAdapter();
			$getId = $this->getRequest()->getRequest('id');
			$customerTable = Ccc::getModel('Product')->load($getId);
			$query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media b ON p.productId = b.productId  WHERE p.productId = $getId;";

			$result1 = $adapter->fetchPair($query1);
			
			if (!isset($getId)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid'));	
				//throw new Exception("Invalid Request.", 1);
			}
			$delete = $customerTable->delete(['productId' => $getId]); 
			if(!$delete)
			{
				$message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);			
				$this->redirect($this->getUrl('grid'));	
				//throw new Exception("System is unable to delete.", 1);							
			}

			foreach($result1 as $key => $value){
               if($delete)
               {
              
                  unlink($this->getBaseUrl('Media/Product/') . $value);
               }
            }

			$this->redirect($this->getUrl('grid','product',null,true));
		} catch (Exception $e) 
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}
}

?>