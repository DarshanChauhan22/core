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
            if(!$customerModel)
            {
                throw new Exception("Invalid Request.");
            }
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
            $this->redirect('grid',null,null,true);
        }
    }


    public function saveCustomer()
    {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        
        try
        {
            $request=$this->getRequest();
            $customerId = (int)$this->getRequest()->getRequest('id');
            $customer = Ccc::getModel('Customer')->load($customerId);
        
        if(!$request->isPost() || !$request->getPost('customer')) 
        {
            throw new Exception("Invalid Request.", 1);             
        }
                    
        $row = $request->getPost('customer');
        
        if ($customer) 
        {
            if(!(int)$row['customerId'])
            {
                throw new Exception("Invalid Request.", 1);
            }
            $customer = Ccc::getModel("Customer")->load($row['customerId']);
            $customer->updatedAt = date('Y-m-d H:i:s');
        }
        else
        {
            $customer = Ccc::getModel("Customer");
            $customer->createdAt = date('Y-m-d H:i:s');
        }

        $customer->setData($row);
        $customer = $customer->save();
        
        if(!$customer)
        {   
                throw new Exception("System is unable to insert.", 1);
        }
        $this->getMessage()->addMessage('Insert Successfully.');
        return $customer->customerId;





            /*$row = $this->getRequest()->getPost('customer');
            print_r($row);
            exit;    
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 
            $customerId = (int)$this->getRequest()->getRequest('id');
            $customer = Ccc::getModel('Customer')->load($customerId);

            //print_r($customer); die;
            if(!$customer)
            {
                $customer = Ccc::getModel('Customer');
                $customer->setData($row);
                $customer->createdAt = $date;
                $result = $customer->save();
            }
            else
            {
                $customer->setData($row);
                $customer->updatedAt = $date;
                $result = $customer->save();
                die;
            }
            return $result->customerId;

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect('grid','customer',null,true));*/
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('grid','customer',null,true);
        }

}             

    protected function saveAddress($customerId)
    {
        try 
        {   
        $message = $this->getMessage();
        $address = Ccc::getModel('Customer_Address');
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        $billingRow = $this->getRequest()->getPost('billingAddress');
        $shippingRow = (array_key_exists('same', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
        $customerModel = Ccc::getModel('customer')->load($customerId);
        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();

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
        $billingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;

        $shippingAddress->setData($shippingRow);
        $shippingAddress->billing = 0;
        $shippingAddress->shipping = 1;
        $shippingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;

        $billingAddress->save();
        $shippingAddress->save();

        $message->addMessage('Update Successfully.');

    


        /*if($billingData != null)
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
        
        }*/
        
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect('grid',null,null,true);
        }
       
    }

    public function saveAction()
    {
        try {
            $customerId = $this->saveCustomer();
            $this->saveAddress($customerId);
            $this->redirect('grid','customer',['id' => null],false);
        } catch (Exception $e) {
            $this->redirect('grid','customer',null,true);
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
            $this->redirect('grid',null,['id' => null],false);      
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect('grid',null,['id' => null],false);
        }
    }
}

