<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php Ccc::loadClass("Model_Core_Request"); ?>
<?php
class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock("Customer_Grid");
        $content->addChild($customerGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $customer = Ccc::getModel('Customer');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer]);
        $content->addChild($customerAdd);
        $this->renderLayout();  
    }

    public function editAction()
    {
         try 
        {
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $customer = Ccc::getModel('Customer')->load($id);

            $customer = $customer->fetchRow("select c.*,a.* from customer c join address a on a.customerId = c.customerId WHERE c.customerId = {$id} ");
            
            if(!$customer)
            {
                throw new Exception("unable to load customer.");
            }
            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer]);
            $content->addChild($customerEdit);
            $this->renderLayout(); 
        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));
        }
    }
    protected function saveCustomer()
    {

        try 
        {

        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $row = $this->getRequest()->getRequest('customer');
        $customer = Ccc::getModel('Customer');
    
        if (!$row) 
        {
            throw new Exception("Invalid Request.");               
        }           

        if(array_key_exists('customerId',$row) && $row['customerId'] == null)
        {
            $customer->firstName = $row['firstName'];
            $customer->lastName =  $row['lastName'];
            $customer->email =  $row['email'];
            $customer->mobile =  $row['mobile'];
            $customer->status =  $row['status'];
            $result = $customer->save();
            return $result;

            if(!$result)
            {
               throw new Exception("Insert Unsuccessfully.");
            }
            $message->addMessage('Insert Successfully.');

        }
        else
        {
            $customer->setData($row);
            $customer->updatedAt =  $date;
            $customer->save();
            return $row['customerId'];

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

                

    protected function saveAddress($customerId)
    {
       
        $address = Ccc::getModel('Customer_Address'); 
        try 
        {
        $message = $this->getMessage();
        $row = $this->getRequest()->getRequest('address');
       

        if (!$row) 
        {
            throw new Exception("Invalid Request.");
        }
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $billing = 2;
        $shipping = 2;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) 
        {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) 
        {
            $shipping = 1;
        }
        $addressData = $address->fetchRow(
            "SELECT * FROM address WHERE customerId = $customerId"
        );


        if(!$addressData)
        {
            $address->customerId = $customerId;
            $address->address =  $row['address'];
            $address->city =  $row['city'];
            $address->state =  $row['state'];
            $address->country =  $row['country'];
            $address->postalCode =  $row['postalCode'];
            $address->billing =  $row['billing'];
            $address->shipping =  $row['shipping'];
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Insert Unsuccessfully.");
            }
            $message->addMessage('Insert Successfully.');

        }
        else
        {
            $address->setData($row);
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

