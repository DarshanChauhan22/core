<?php
   /* echo "<pre>";*/
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Vendor extends Controller_Core_Action
{ 
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock("Vendor_Grid");
        $content->addChild($vendorGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $vendor = Ccc::getModel('Vendor');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor);
        $content->addChild($vendorAdd);
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
                throw new Exception("Id not valid.");
            }
            $vendor = Ccc::getModel('Vendor')->load($id);

            $vendor = $vendor->fetchRow("select c.*,a.* from vendor c join vendor_address a on a.vendorId = c.vendorId WHERE c.vendorId = {$id} ");
            
            if(!$vendor)
            {
                throw new Exception("unable to load vendor.");
            }
         $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor);
            $content->addChild($vendorEdit);
            $this->renderLayout();    
        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));  
        }
    }
    protected function saveVendor()
    {

        try 
        {
            $message = Ccc::getModel('Core_Message');
            date_default_timezone_set("Asia/Kolkata");
            $date = date("Y-m-d H:i:s");
            $row = $this->getRequest()->getRequest('vendor');
            $vendor = Ccc::getModel('Vendor');
            
            if (!isset($row)) 
            {
                throw new Exception("Invalid Request.", 1);               
            }   

        if(array_key_exists('vendorId',$row) && $row['vendorId'] == null)
        {
                $vendor->firstName = $row['firstName'];
                $vendor->lastName =  $row['lastName'];
                $vendor->email =  $row['email'];
                $vendor->mobile =  $row['mobile'];
                $vendor->status =  $row['status'];
                $vendor->createdAt =  $date;
                $vendor->updatedAt =  null;
                $result = $vendor->save();
                 if(!$result)
                {
                    throw new Exception("Insert Unsuccessfully.",1);
                }
                    $message->addMessage('Insert Successfully.');
                return $result;


        }
        else{

                $vendor->load($row['vendorId']);
                $vendor->vendorId = $row["vendorId"];
                $vendor->firstName = $row['firstName'];
                $vendor->lastName =  $row['lastName'];
                $vendor->email =  $row['email'];
                $vendor->mobile =  $row['mobile'];
                $vendor->status =  $row['status'];
                $vendor->updatedAt =  $date;
                $result = $vendor->save();
                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.",1);
                }
                $message->addMessage('Update Successfully.');
                return $row['vendorId'];


        }
            } catch (Exception $e) 
        {
           $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));  
        }
    }




      
    protected function saveAddress($vendorId)
    {
        
        $address = Ccc::getModel('Vendor_Address'); 
        try 
        {
            $message = Ccc::getModel('Core_Message');
        $row = $this->getRequest()->getRequest('address');

        if (!isset($row)) 
        {
            throw new Exception("Invalid Request.", 1);
        }
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $addressData = $address->fetchRow(
            "SELECT * FROM vendor_address WHERE vendorId = $vendorId"
        );

         if(!$addressData)
        {
            
                $address->vendorId = $vendorId;
                $address->address =  $row['address'];
                $address->city =  $row['city'];
                $address->state =  $row['state'];
                $address->country =  $row['country'];
                $address->postalCode =  $row['postalCode'];
                $result = $address->save();
                
                if(!$result)
                {
                    throw new Exception("Insert Unsuccessfully.",1);
                }
                    $message->addMessage('Insert Successfully.');

        }
        else{
            
               $address->load($row['vendorAddressId']);
               $address->vendorAddressId = $row["vendorAddressId"];
               $address->vendorId = $vendorId;
               $address->address =  $row['address'];
               $address->city =  $row['city'];
               $address->state =  $row['state'];
               $address->country =  $row['country'];
               $address->postalCode =  $row['postalCode'];
               $result = $address->save();

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.",1);
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
            $vendorId = $this->saveVendor();
            $this->saveAddress($vendorId);
            $this->redirect($this->getUrl('grid','vendor',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','vendor',null,true));
        }
    }

    public function deleteAction()
    {
        $message = Ccc::getModel('Core_Message');
        $getId = $this->getRequest()->getRequest('id');
        $vendorTable = Ccc::getModel('Vendor')->load($getId); 
        try {
            if (!isset($getId)) 
            {
                throw new Exception("Invalid Request.", 1);
            }
            $delete = $vendorTable->delete(['vendorId' => $getId]);
            if (!$delete) 
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Delete Successfully.');       
            $this->redirect($this->getUrl('grid','vendor',null,true));
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));  
        }
    }
}
?>
