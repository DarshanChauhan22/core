<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php Ccc::loadClass("Model_Core_Request"); ?>
<?php
class Controller_Customer extends Controller_Core_Action
{

    public function gridAction()
    {
        $this->setTitle("Customer Grid");
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock("Customer_Grid");
        $content->addChild($customerGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle("Customer Add");
        $customer = Ccc::getModel('Customer');
        $billingAddress = Ccc::getModel('Customer_Address');
        $shippingAddress = Ccc::getModel('Customer_Address');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer , 'billingAddress' => $billingAddress , 'shippingAddress' => $shippingAddress]);
        $content->addChild($customerAdd);
        $this->renderLayout();  
    }

    public function editAction()
    {
        try 
        {
            $this->setTitle("Customer Edit");
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $customerModel = Ccc::getModel('Customer')->load($id);
           // $address = Ccc::getModel('Customer_Address');
            $customer = $customerModel->fetchRow("SELECT * from customer WHERE customerId = {$id} ");
                //print_r($customer); die;

            $billingAddress = $customerModel->getBillingAddress();
            $shippingAddress = $customerModel->getShippingAddress();

            //print_r($billingAddress); die;
           // $billingAddress = $address->fetchRow("SELECT * FROM address WHERE customerId = {$id} AND billing =1; ");
            //$shippingAddress = $address->fetchRow("SELECT * FROM address WHERE customerId = {$id} AND shipping =1; ");

            if(!$customer)
            {
                throw new Exception("unable to load customer.");
            }
            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer , 'billingAddress' => $billingAddress , 'shippingAddress' => $shippingAddress]);
            $content->addChild($customerEdit);
            $this->renderLayout(); 
        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));
        }
    }


    public function saveCustomer()
    {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        
        try
        {
            $row = $this->getRequest()->getRequest('customer');
            /*print_r($row);
            exit; */   
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 
            $customerId = (int)$this->getRequest()->getRequest('id');
            $customer = Ccc::getModel('Customer')->load($customerId);

            if(!$customer)
            {
                $customer = Ccc::getModel('Customer');
                $customer->setData($row);
                $customer->createdAt = $date;
            }
            else
            {
                $customer->setData($row);
                $customer->updatedAt = $date;
            }
            $result = $customer->save();
            return $result->customerId;

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getUrl('grid','customer',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','customer',null,true));
        }

}             

    protected function saveAddress($customerId)
    {
       
        $address = Ccc::getModel('Customer_Address'); 
        try 
        {
        $message = $this->getMessage();
        $billingRow = $this->getRequest()->getRequest('billingaddress');
        $shippingRow = $this->getRequest()->getRequest('shippingaddress');
      /* echo "<pre>";
         print_r($billingRow);
         print_r($shippingRow);
            exit;*/
        /*if (!$row) 
        {
            throw new Exception("Invalid Request.");
        }*/
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
         /*$addressData = $address->fetchRow(
            "SELECT * FROM address WHERE customerId = $customerId"
        );*/
        $customerModel = Ccc::getModel('customer')->load($customerId);
        $billingData = $customerModel->getBillingAddress();
        //$shippingData = $customerModel->getShippingAddress();
        /*print_r($billingData);
        print_r($shippingData); die;*/
       /* print_r($addressData); 
        print_r($billingData); die;*/
        if($billingData != null)
        {
            
            $address = Ccc::getModel('Customer_Address');
            $address->setData($billingRow);
            $address->customerId = $customerId;
            $address->billing =  1;
            $address->shipping =  0;
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Insert Unsuccessfully.");
            }
            $message->addMessage('Insert Successfully.');

        }
        else
        {
            $address->setData($billingRow);
            $result = $address->save();
                
            if(!$result)
            {
                throw new Exception("Update Unsuccessfully.");
            }
            $message->addMessage('Update Successfully.');
                
        }
        

         if($billingData != null)
        {
            $address = Ccc::getModel('Customer_Address');
            $address->setData($shippingRow);
            $address->customerId = $customerId;
            $address->billing =  0;
            $address->shipping =  1;
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Insert Unsuccessfully.");
            }
            $message->addMessage('Insert Successfully.');

        }
        else
        {
            $address->setData($shippingRow);
            $result = $address->save();

            if(!$result)
            {
                throw new Exception("Update Unsuccessfully.");
            }
            $message->addMessage('Update Successfully.');
        
        }
        
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));
        }
       
    }

    public function saveAction()
    {
        try {
            $customerId = $this->saveCustomer();
            $this->saveAddress($customerId);
            $this->redirect($this->getUrl('grid','customer',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','customer',null,true));
        }
    }

    public function deleteAction()
    {
        try {
            $message = $this->getMessage();
            $getId = $this->getRequest()->getRequest('id');
            $customerTable = Ccc::getModel('Customer')->load($getId); 
            if (!$getId) 
            {
                throw new Exception("Invalid Request.");
            }
            $delete = $customerTable->delete(['customerId' => $getId]);
            if (!$delete) 
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Delete Successfully.');           
            $this->redirect($this->getUrl('grid',null,null,true));      
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));
        }
    }
}

