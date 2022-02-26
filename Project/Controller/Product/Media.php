<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Product_Media');
Ccc::loadClass('Model_Core_Request');

class Controller_Product_Media extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Product_Media_grid')->toHtml();
	}

	public function saveAction()
   {
      global $adapter;
      try 
      {
        //$productMedia = Ccc::getModel('Product_Media');

          $request =$this->getRequest();
          $productId = $request->getRequest('id');

          $media = Ccc::getModel('Product_Media');

          if(!$request->isPost()){
            throw new Exception("Invalid Request" , 1);
          }

          $rows = $request->getPost();
         echo "<pre>";
          print_r($rows);
         exit;
           
            $media = $rows['media'];
            $removeArr = $rows['media']['remove'];
           /* print_r($removeArr);
            print_r($remove);
            */
        

            if(array_key_exists('remove',$media))
            {
                 
                $removeIds = [];
                foreach($removeArr as $key => $value)
                {
                   array_push($removeIds ,$value);
                }
                //print_r($removeIds);
                $removeIdsImplode = implode(",",$removeIds);
                //echo $removeIdsImplode;

                $query="DELETE FROM `product_media` WHERE imageId IN($removeIdsImplode)";
                $result = $adapter->delete($query);
                //print_r($result);
                    
            }

            
            $query = "SELECT imageId,productId FROM `product_media` WHERE productId = $productId";
            $result = $adapter->fetchPair($query);
            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);
            
            $query = "UPDATE `product_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";
           
            $result = $adapter->update($query);

            $status = $rows['media']['status'];
            if(array_key_exists('status',$media))
            {
                $statusIds = [];
                foreach($status as $key => $value)
                {
                   array_push($statusIds ,$value);
                }
                //print_r($removeIds);
                $statusIdsImplode = implode(",",$statusIds);
                //echo $removeIdsImplode;
                /*$query = "UPDATE `product_media` SET status = CASE WHEN status = 1 THEN 0 END";
                $result = $adapter->update($query);
                print_r($)
                if($result){}*/
                $query="UPDATE `product_media` SET `status`= 1 WHERE imageId IN($statusIdsImplode)";
                $result = $adapter->update($query);
                 
                //print_r($result);
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
                 
                //print_r($result);
            }



             $base = $rows['media']['base'];
            if(array_key_exists('base',$media))
            {
                $query="UPDATE `product_media` SET `base`= 1 WHERE imageId = {$base}";
                $result = $adapter->update($query);
                 
                //print_r($result);
            }

            $thumb = $rows['media']['thumb'];
            if(array_key_exists('thumb',$media))
            {
                $query="UPDATE `product_media` SET `thumb`= 1 WHERE imageId = {$thumb}";
                $result = $adapter->update($query);
                 
                //print_r($result);
            }

            $small = $rows['media']['small'];
            if(array_key_exists('small',$media))
            {
                $query="UPDATE `product_media` SET `small`= 1 WHERE imageId = {$small}";
                $result = $adapter->update($query);
                 
                //print_r($result);
            }

          $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));

      } catch (Exception $e) 
      {
          echo $e->getMessage();
      }
   }

       public function addAction()
       {

       		$productId = $_GET['id'];

      //$mediaTable = Ccc::getModel('Media_Resource');
      $imageName1 = $_FILES['image']['name'];
      $imageAddress1 = $_FILES['image']['tmp_name'];
      $imageName = implode("", $imageName1);
      $imageName = date("mjYhis")."-".$imageName;
      $imageAddress = implode("", $imageAddress1);
      
     // $media = Ccc::getModel('Product_Media');
         
            //$media = $mediaModel->getRow();

       //  $row = $this->getRequest()->getRequest('product_media');
         
      if(move_uploaded_file($imageAddress , 'C:\xampp\htdocs\core\core\Project\Media\Product/'. $imageName))
         {
            global $adapter;
            $query =  "INSERT INTO `product_media`( `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($productId,'$imageName',0,0,0,0,0)";
          
            $result = $adapter->insert($query);
           

           //header('location :index.php?c=product&a=grid');
           $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));
           // $this->redirect("index.php?c=product&a=grid");
           // $this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
         }
         else
         {
            //$this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
         }  

       }
       
}


?>


<!-- SELECT p.*,b.imageId,t.imageId,s.imageId FROM product p 
LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1)
LEFT JOIN product_media t ON p.productId = t.productId AND (t.thumb = 1)
LEFT JOIN product_media s ON p.productId = s.productId AND (s.small = 1);


 -->
 -->