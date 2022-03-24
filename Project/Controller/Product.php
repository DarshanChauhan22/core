<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');


class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		$this->setTitle("Product Grid");
		$content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock("Product_Grid");
        $content->addChild($productGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle("Product Add");
		$product = Ccc::getModel('Product');
		$content = $this->getLayout()->getContent();
      $productAdd = Ccc::getBlock("Product_Edit")->setData(['product' => $product , 'categoryProductPair' => []]);
      $content->addChild($productAdd);
      $this->renderLayout();	
	}

	public function editAction()
	{

		try 
		{
			$this->setTitle("Product Edit");
			$message = $this->getMessage();
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$product = Ccc::getModel('Product')->load($id);
			if(!$product)
			{
				throw new Exception("unable to load product.");
			}
				$content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock("Product_Edit");
				$categoryPath = Ccc::getModel('Category');
            $productEdit->setData(['product' => $product , 'categoryProductPair' => $this->getAdapter()->fetchPair("SELECT entityId,categoryId FROM `category_product` WHERE `productId` = {$id}") , 'categoryPath'=> $categoryPath ] );;
       
            $content->addChild($productEdit);
            $this->renderLayout();		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,null,true);	
		}

	}
		

	public function saveAction()
	{
		try {

			$message = $this->getMessage();
			$product = Ccc::getModel('Product');
			$row =  $this->getRequest()->getRequest('product');
			//print_r($row); die;
			$categoryProductRow =  Ccc::getModel('Category_Product');

			$categoryIds = $this->getRequest()->getPost('category');

			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$productId = $row["productId"];
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");

			 if(array_key_exists('productId',$row) && $row['productId'] == null)
       		 {
       		 	
       		 	unset($row['productId']);
       		 	if(array_key_exists('category',$row))
       		 	{
       		 		$categoryArray = $row['category'];
       		 		unset($row['category']);
       		 	}
                $product->setData($row);
                $result = $product->save();
                $result = $result->productId;
              
                $product->saveCategories($categoryArray, $result);
                if(!$result)
                {
                	throw new Exception("Error Processing Request", 1);
                	
                }
       		 	
                if(!$result)
                {
                	throw new Exception("Insert Unsuccessfully.",1);
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{
        		$product->load($row['productId']);
        			$product->productId = $row["productId"];
               $product->name = $row['name'];
               $product->price =  $row['price'];
               $product->tax =  $row['tax'];
               $product->quantity =  $row['quantity'];
               $product->cost =  $row['cost'];
               $product->discount =  $row['discount'];
               $product->discountMode =  $row['discountMode'];
               $product->sku =  $row['sku'];
               $product->status =  $row['status'];
               $product->updatedAt =  $date;
               $result = $product->save();
        		/*$product = Ccc::getModel('product');
        		$product->setData($row);
            $product->updatedAt =  $date;
            $result = $product->save();*/

    		 	$categoryProduct = $row['category'];
    		 	unset($row['category']);
           	$product->saveCategories($categoryProduct);


             if(!$result)
             {
						throw new Exception("Update Unsuccessfully.",1);
             }
				$message->addMessage('Update Successfully.');
       			}

			$this->redirect('grid','product',['id' => null],false);
			
		} catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,null,true);	
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$adapter = $this->getAdapter();
			$mediaModel = Ccc::getModel('Product_Media');
			$getId = $this->getRequest()->getRequest('id');
			$customerTable = Ccc::getModel('Product')->load($getId);
			$query1 = "SELECT imageId,image FROM product p LEFT JOIN `product_media` b ON p.productId = b.productId  WHERE p.productId = $getId;";

			$result1 = $adapter->fetchPair($query1);
			
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $customerTable->delete(['productId' => $getId]); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			foreach($result1 as $key => $value){
               if($delete)
               {
              
                  unlink( $mediaModel->getImagePath() . $value);
               }
            }

			$message->addMessage('Delete Successfully.');
			$this->redirect('grid','product',['id' => null],false);
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,['id' => null],false);	
		}
	}
}

