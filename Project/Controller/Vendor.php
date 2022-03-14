<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php Ccc::loadClass("Model_Core_Request"); ?>
<?php
class Controller_Vendor extends Controller_Core_Action
{ 
    public function gridAction()
    {
        $this->setTitle("Vendor Grid");
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock("Vendor_Grid");
        $content->addChild($vendorGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle("Vendor Add");
        $vendor = Ccc::getModel('Vendor');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendor]);
        $content->addChild($vendorAdd);
        $this->renderLayout();

    }

    public function editAction()
    {
         try 
        {
            $this->setTitle("Vendor Edit");
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $vendor = Ccc::getModel('Vendor')->load($id);

            $vendor = $vendor->fetchRow("SELECT c.*,a.* FROM vendor c join `vendor_address` a on a.vendorId = c.vendorId WHERE c.vendorId = {$id} ");
            
            if(!$vendor)
            {
                throw new Exception("unable to load vendor.");
            }
         $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendor]);
            $content->addChild($vendorEdit);
            $this->renderLayout();    
        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));  
        }
    }

    public function saveVendor()
    {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        
        try
        {
            $row = $this->getRequest()->getPost('vendor');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 
            $vendorId = (int)$this->getRequest()->getRequest('id');
            $vendor = Ccc::getModel('Vendor')->load($vendorId);

            if(!$vendor)
            {
                $vendor = Ccc::getModel('Vendor');
                $vendor->setData($row);
                $vendor->createdAt = $date;
            }
            else
            {
                $vendor->setData($row);
                $vendor->updatedAt = $date;
            }
            $result = $vendor->save();
            return $result->vendorId;

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getUrl('grid','vendor',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','vendor',null,true));
        }

}
    
      
    protected function saveAddress($vendorId)
    {
        $address = Ccc::getModel('Vendor_Address'); 
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
        $addressData = $address->fetchRow(
            "SELECT * FROM `vendor_address` WHERE `vendorId` = {$vendorId}"
        );

        if(!$addressData)
        {
            $address = Ccc::getModel('Vendor_Address');
            $address->setData($row);
            $address->vendorId = $vendorId;
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
            $vendorId = $this->saveVendor();
            $this->saveAddress($vendorId);
            $this->redirect($this->getUrl('grid','vendor',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','vendor',null,true));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $vendorTable = Ccc::getModel('Vendor')->load($getId); 
        try {
            if (!$getId) 
            {
                throw new Exception("Invalid Request.");
            }
            $delete = $vendorTable->delete(['vendorId' => $getId]);
            if (!$delete) 
            {
                throw new Exception("System is unable to delete record.");
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

