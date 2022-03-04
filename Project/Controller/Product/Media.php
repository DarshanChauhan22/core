<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Product_Media');
Ccc::loadClass('Model_Core_Request');

class Controller_Product_Media extends Controller_Core_Action{
	
	public function gridAction()
	{
        $content = $this->getLayout()->getContent();
        $mediaGrid = Ccc::getBlock("Product_Media_grid");
        $content->addChild($mediaGrid);
        $this->renderLayout();
	}

	public function saveAction()
   {
      $message = Ccc::getModel('Core_Message');
      $adapter = $this->getAdapter();;
      try 
      {

          $productId = $this->getRequest()->getRequest('id');

          $media = Ccc::getModel('Product_Media');

          if(!$this->getRequest()->isPost())
          {
            $message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
            //throw new Exception("Invalid Request" , 1);
          }

          $rows = $this->getRequest()->getPost();
         
         if(!$rows)
            {
                $message->addMessage('Id not valid.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                //throw new Exception("Id not valid.");
            }

            $media = $rows['media'];
            $removeArr = $rows['media']['remove'];

            if(array_key_exists('remove',$media))
            {
                 
                $removeIds = [];
                foreach($removeArr as $key => $value)
                {
                   array_push($removeIds ,$value);
                }
                $removeIdsImplode = implode(",",$removeIds);

                $query1 = "SELECT imageId , image FROM `product_media` WHERE imageId IN($removeIdsImplode) ";
                $result1 = $adapter->fetchPair($query1);
                
                $query="DELETE FROM `product_media` WHERE imageId IN($removeIdsImplode)";
                $result = $adapter->delete($query);
                if(!$result)
                {
                    $message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);           
                    $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Delete Successfully.');   
                foreach($result1 as $key => $value){
               if($result)
               {
                  unlink($this->getBaseUrl('Media/Product/') . $value);
               }
            }
                    
            }

            
            $query = "SELECT imageId,productId FROM `product_media` WHERE productId = $productId";
            $result = $adapter->fetchPair($query);

            if(!$result)
            {
                 $message->addMessage('System is unable to fetch Pairs.',Model_Core_Message::ERROR);           
                 $this->redirect($this->getUrl('grid',null,null,true));
            }
            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);
            
            $query = "UPDATE `product_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";
           
            $result = $adapter->update($query);

            if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');


            $status = $rows['media']['status'];
            if(array_key_exists('status',$media))
            {
                $statusIds = [];
                foreach($status as $key => $value)
                {
                   array_push($statusIds ,$value);
                }
                $statusIdsImplode = implode(",",$statusIds);
               
                $query="UPDATE `product_media` SET `status`= 1 WHERE imageId IN($statusIdsImplode)";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');
            }


            $gallery = $rows['media']['gallery'];
            if(array_key_exists('gallery',$media))
            {
                $galleryIds = [];
                foreach($gallery as $key => $value)
                {
                   array_push($galleryIds ,$value);
                }
                print_r($galleryIds);
                $galleryIdsImplode = implode(",",$galleryIds);
                $query="UPDATE `product_media` SET `gallery`= 1 WHERE imageId IN($galleryIdsImplode)";
               
         
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');
            }



             $base = $rows['media']['base'];
            if(array_key_exists('base',$media))
            {
                $query="UPDATE `product_media` SET `base`= 1 WHERE imageId = {$base}";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');
            }

            $thumb = $rows['media']['thumb'];
            if(array_key_exists('thumb',$media))
            {
                $query="UPDATE `product_media` SET `thumb`= 1 WHERE imageId = {$thumb}";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');
            }

            $small = $rows['media']['small'];
            if(array_key_exists('small',$media))
            {
                $query="UPDATE `product_media` SET `small`= 1 WHERE imageId = {$small}";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
                $message->addMessage('Update Successfully.');
            }

          $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));

      } catch (Exception $e) 
      {
          echo $e->getMessage();
      }
   }

       public function addAction()
       {

        try {
              $message = Ccc::getModel('Core_Message');
              $productId = $this->getRequest()->getRequest('id');

              $imageName1 = $_FILES['image']['name'];
              $imageAddress1 = $_FILES['image']['tmp_name'];
              $imageName = implode("", $imageName1);
              $imageName = date("mjYhis")."-".$imageName;
              $imageAddress = implode("", $imageAddress1);
    
      if(move_uploaded_file($imageAddress , $this->getBaseUrl('Media/product/') . $imageName))
         {
            $adapter = $this->getAdapter();
            $query =  "INSERT INTO `product_media`( `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($productId,'$imageName',0,0,0,0,0)";
          
            $result = $adapter->insert($query);
           
            if(!$result)
                {
                    $message->addMessage('Insert Unsuccessfully.',Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid',null,null,true));
                }
                    $message->addMessage('Insert Successfully.');

           $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));
         }
         else
         {
            $this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
         } 
            
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();    
        }
       		 

       }
       
}


?>

