<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_ShippingMethod extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $shippingMethodGrid = Ccc::getBlock("ShippingMethod_Grid");
        $content->addChild($shippingMethodGrid);
        $this->renderLayout();         
    }

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $shippingMethodGrid = Ccc::getBlock('shippingMethod_Index');
        $content->addChild($shippingMethodGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $shippingMethodGrid = Ccc::getBlock("shippingMethod_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         $response = [
            'status' => 'success',
            'content' => $shippingMethodGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $shippingMethod = Ccc::getModel('shippingMethod');
        Ccc::register('shippingMethod',$shippingMethod);
        $shippingMethodAdd = $this->getLayout()->getBlock('shippingMethod_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $shippingMethodAdd
         ];
        $this->renderJson($response);
    }

   
    public function editBlockAction()
    {

        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $shippingMethodModel = Ccc::getModel('shippingMethod')->load($id);
            $shippingMethod = $shippingMethodModel->fetchRow("SELECT * FROM `shippingMethod` WHERE `methodId` = $id");

            
            if(!$shippingMethod)
            {
                throw new Exception("unable to load shippingMethod.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('shippingMethod',$shippingMethod);
           
            $shippingMethodEdit = Ccc::getBlock("shippingMethod_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $shippingMethodEdit
         ] ;
        $this->renderJson($response);
    }

    public function editAction()
    {
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
               throw new Exception("Id not valid.");
            }
            $shippingMethod = Ccc::getModel('ShippingMethod')->load($id);
            if(!$shippingMethod){
                throw new Exception("unable to load shippingMethod.");
            }
            Ccc::register('shippingMethod',$shippingMethod);
            $content = $this->getLayout()->getContent();
            $shippingMethodEdit = Ccc::getBlock("ShippingMethod_Edit");//->setData(["shippingMethod" => $shippingMethod]);
            $content->addChild($shippingMethodEdit);
            $this->renderLayout();        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);     
            $this->redirect('grid',null,null,true);
        }
    }

    public function addAction()
    {
        $shippingMethod = Ccc::getModel('ShippingMethod');
        $content = $this->getLayout()->getContent();
        Ccc::register('shippingMethod',$shippingMethod);
        $shippingMethodAdd = Ccc::getBlock('ShippingMethod_Edit');//->setData(["shippingMethod" => $shippingMethod]);
        $content->addChild($shippingMethodAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('shippingMethod');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 

            $methodId = (int)$this->getRequest()->getRequest('id');
            $shippingMethod = Ccc::getModel('ShippingMethod')->load($methodId);
            print_r($shippingMethod);
            if(!$shippingMethod)
            {  
                $shippingMethod = Ccc::getModel('ShippingMethod');
                $shippingMethod->setData($row);
                $shippingMethod->createdAt = $date;
            }
            else
            {
                $shippingMethod->setData($row);
                $shippingMethod->updatedAt = $date;
            }
            $result = $shippingMethod->save();

            if (!$result)
            {
                throw new Exception("System is unable to update information.");
            }
            $message->addMessage('Data Saved Successfully'); 
            $this->redirect('gridBlock',null,['id' => null],false);
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('gridBlock',null,['id' => null],false);
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $shippingMethod = Ccc::getModel('ShippingMethod')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $shippingMethod->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully');
           $this->redirect('gridBlock',null,['id' => null],false);
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('gridBlock',null,['id' => null],false);
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}


