<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Customer Grid');
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock("Customer_Grid");
        $content->addChild($customerGrid);
        $this->renderLayout();
    }

     public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $customerGrid = Ccc::getBlock('Customer_Index');
        $content->addChild($customerGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $customerGrid = Ccc::getBlock("Customer_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         //$messageBlock->addMessage('hiiiiiiii');
         $response = [
            'status' => 'success',
            'content' => $customerGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $customer = Ccc::getModel('Customer');
        Ccc::register('customer',$customer);
        $customerBillingAddress = $customer->getBillingAddress();
        $customerShippingAddress = $customer->getShippingAddress();
        Ccc::register('customerBillingAddress',$customerBillingAddress);
        Ccc::register('customerShippingAddress',$customerShippingAddress);
        $customerAdd =$this->getLayout()->getBlock('Customer_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $customerAdd
         ] ;
        $this->renderJson($response);
    }

   
    public function editBlockAction()
    {

        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $customerModel = Ccc::getModel('Customer')->load($id);
            $customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = $id");
            $billing = $customerModel->getBillingAddress();
            $shipping = $customerModel->getShippingAddress();

            
            if(!$customer)
            {
                throw new Exception("unable to load customer.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('customer',$customer);
            Ccc::register('customerBillingAddress',$billing);
            Ccc::register('customerShippingAddress',$shipping);
            $customerEdit = Ccc::getBlock("Customer_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $customerEdit
         ] ;
        $this->renderJson($response);
    }


    public function editAction()
    {
        $this->setTitle('Customer Edit');
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $customerModel = Ccc::getModel('Customer')->load($id);
            $customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = {$id}");
            $billing = $customerModel->getBillingAddress();
            $shipping = $customerModel->getShippingAddress();
            
            if(!$customer)
            {
                throw new Exception("unable to load customer.");
            }
            $content = $this->getLayout()->getContent();
            Ccc::register('customer',$customer);
            Ccc::register('customerBillingAddress',$billing);
            Ccc::register('customerShippingAddress',$shipping);
            $customerEdit = Ccc::getBlock("Customer_Edit");//->setData(['customer' => $customer , 'billing' => $billing , 'shipping' => $shipping]);
            $content->addChild($customerEdit);
            $this->renderLayout();      
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('grid','customer',null,true);
        }
    }

    public function addAction()
    {
        $this->setTitle('Customer Add');
        $customer = Ccc::getModel('Customer');
        $content = $this->getLayout()->getContent();
        Ccc::register('customer',$customer);
        $customerBillingAddress = $customer->getBillingAddress();
        $customerShippingAddress = $customer->getShippingAddress();
        Ccc::register('customerBillingAddress',$customerBillingAddress);
        Ccc::register('customerShippingAddress',$customerShippingAddress);
        $customerAdd = Ccc::getBlock('Customer_Edit');//->setData(['customer' => $customer , 'billing' => $billing , 'shipping' => $shipping]);
        $content->addChild($customerAdd);
        $this->renderLayout();
    }

    protected function saveCustomer()
    {
        $customer = Ccc::getModel('Customer');
        $getSaveData = $this->getRequest()->getRequest('customer');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage();

        if (!$getSaveData)
        {
            return;
        }


        if(!$customer)
        {
            $customer = Ccc::getModel('Customer');
            $customer->setData($getSaveData);
            $customer->createdAt = $date;
        }
        else
        {
            $customer->setData($getSaveData);
            $customer->updatedAt = $date;
        }
        $result = $customer->save();
        //return $result->id;

        if (!$result) 
        {
            throw new Exception("You can not update data in customer.");
        } 
        else 
        {
            $message->addMessage('Updated Successfully.');
            $this->redirect('addBlock','customer',['id' => $result->customerId , 'tab' => 'address'],true);
        }
    }

    protected function saveAddress()    
    {
        $customerId = $this->getRequest()->getRequest('id');
        $message = $this->getMessage();
        $address = Ccc::getModel('Customer_Address');
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        $billingRow = $this->getRequest()->getPost('billingAddress');
        $shippingRow = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
        $customerModel = Ccc::getModel('customer')->load($customerId);

        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();

        Ccc::register('customer',$customerModel);
        Ccc::register('customerBillingAddress',$billingAddress);
        Ccc::register('customerShippingAddress',$shippingAddress);

        if(!$billingAddress->getData())
        {   
            $billingAddress->customerId = $customerId;

        }
        if(!$shippingAddress->getData())
        {
            $shippingAddress->customerId = $customerId;
        }
        $billingAddress->setData($billingRow);
        $billingAddress->billing = 1;
        $billingAddress->shipping = 0;
        $billingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

        $shippingAddress->setData($shippingRow);
        $shippingAddress->billing = 0;
        $shippingAddress->shipping = 1;
        $shippingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

        $billingAddress->save();
        $shippingAddress->save();

        $message->addMessage('Insert successfully.');

    }

    public function saveAction()
    {
        try
        {

            $this->saveCustomer();
            $this->saveAddress();
            
            $this->redirect('gridBlock',null,['id' => null],false);
        } 
        
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('gridBlock',null,['id' => null],false);
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $customer = Ccc::getModel('Customer')->load($getId);
        try
        {   
            if (!$getId) 
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result=$customer->delete();
            if(!$result)
            {
                throw new Exception("System is unable to delete record.");  
            }
            $message->addMessage('Deleted Successfully');
            /*$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
             $response = [
            'status' => 'success',
            'content' => $customerAdd,
            'message' =>$messageBlock
         ] ;
        $this->renderJson($response);*/

            $this->redirect('gridBlock',null,['id' => null],false);
        }
        catch (Exception $e)
        {
           /* $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);   
            $customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
             $response = [
            'status' => 'failed',
            'content' => $customerGrid,
            'message' =>$messageBlock
         ] ;
        $this->renderJson($response);*/
      
            $this->redirect('gridBlock',null,['id' => null],false);
        }
    }

    /*public function errorAction()
    {
        echo "error";
    }*/

}

?>