<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_Category_Media extends Controller_Core_Action{
	
	public function gridAction()
	{
        $this->setTitle("Media Grid");
        $content = $this->getLayout()->getContent();
        $mediaGrid = Ccc::getBlock("Category_Media_grid");
        $content->addChild($mediaGrid);
        $this->renderLayout();
	}

	public function saveAction()
   {
      $adapter = $this->getAdapter();
      try 
      {
        $message = $this->getMessage();

          $request =$this->getRequest();
          $categoryId = $request->getRequest('id');

          $mediaModel = Ccc::getModel('Category_Media');

          if(!$request->isPost())
          {
               throw new Exception("Invalid Request" );
          }

          $rows = $request->getPost();
         
             if(!$rows)
            {
                throw new Exception("Id not valid.");
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

                $query1 = "SELECT imageId , image FROM `category_media` WHERE `imageId` IN($removeIdsImplode) ";
                $result1 = $adapter->fetchPair($query1);

                $query="DELETE FROM `category_media` WHERE `imageId` IN($removeIdsImplode)";
                $result = $adapter->delete($query);
                if(!$result)
                {
                    throw new Exception("Delete Unsuccessfully.");
                }
                $message->addMessage('Delete Successfully.');   
                foreach($result1 as $key => $value){
               if($result)
               {                
                  unlink($mediaModel->getImagePath() . $value);
               }
              }  
            }

            
            $query = "SELECT imageId,categoryId FROM `category_media` WHERE `categoryId` = {$categoryId}";
            $result = $adapter->fetchPair($query);

            if(!$result)
            {
                 $message->addMessage('System is unable to fetch Pairs.',Model_Core_Message::ERROR);           
                 $this->redirect('grid',null,null,true);
            }

            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);
            
            $query = "UPDATE `category_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";
           
            $result = $adapter->update($query);

            if(!$result)
                {
                throw new Exception("Update Unsuccessfully.");
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
                
                $query="UPDATE `category_media` SET `status`= 1 WHERE `imageId` IN($statusIdsImplode)";
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
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
                $query="UPDATE `category_media` SET `gallery`= 1 WHERE `imageId` IN($galleryIdsImplode)";
               
         
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
                 
            }



             $base = $rows['media']['base'];
            if(array_key_exists('base',$media))
            {
                $query="UPDATE `category_media` SET `base`= 1 WHERE `imageId` = {$base}";
                $result = $adapter->update($query);

                if(!$result)
                {
                $message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect('grid',null,null,true);
                }
                $message->addMessage('Update Successfully.');
                 
            }

            $thumb = $rows['media']['thumb'];
            if(array_key_exists('thumb',$media))
            {
                $query="UPDATE `category_media` SET `thumb`= 1 WHERE `imageId` = {$thumb}";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }

            $small = $rows['media']['small'];
            if(array_key_exists('small',$media))
            {
                $query="UPDATE `category_media` SET `small`= 1 WHERE `imageId` = {$small}";
                $result = $adapter->update($query);
                 
                 if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }

          $this->redirect('grid','category_media',['id'=> $categoryId]);

      } catch (Exception $e) 
      {
         $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect('grid',null,null,true);  
      }
   }

       public function addAction()
       {
            try 
            {
                $this->setTitle("Media Add");
                $mediaModel = Ccc::getModel('Category_Media');
               $message = $this->getMessage();
               $categoryId = $_GET['id'];

              $imageName1 = $_FILES['image']['name'];
              $imageAddress1 = $_FILES['image']['tmp_name'];
              $imageName = implode("", $imageName1);
              $imageName = date("mjYhis")."-".$imageName;
              $imageAddress = implode("", $imageAddress1);
         
      if(move_uploaded_file($imageAddress , $mediaModel->getImagePath() . $imageName))
         {
            $adapter = $this->getAdapter();
            $query =  "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ({$categoryId},'$imageName',0,0,0,0,0)";
          
            $result = $adapter->insert($query);
           
            if(!$result)
                {
                    throw new Exception("Insert Unsuccessfully.");
                }
                    $message->addMessage('Insert Successfully.');

           $this->redirect('grid','category_media',['id'=> $categoryId]);
         }
         else
         {
            $this->redirect('grid','category_media',['id' =>  $categoryId],true);
         }  
    
            } catch (Exception $e) 
            {
                $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
                $this->redirect('grid',null,null,true);
            }
       		
       }
       
}


?>


