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
        //Ccc::getBlock("Vendor_Grid")->toHtml();
        /*$vendorModel = Ccc::getModel('vendor');
        echo "<pre>";
        //print_r($vendorModel);
        $vendor = $vendorModel->getRow();
        print_r($vendor);
        $vendor->vendorId = '146';
        $vendor->firstName = 'dc';
        $vendor->lastName = 'dc';
        $vendor->mobile = '900000';
        $vendor->status = '1';
        //$vendor = $vendorModel->load(146);
        $vendor->lastName = 'dc';
        unset($vendor->lastName);
        //print_r($vendor);
        print_r($vendor);
        $vendor->save();*/
    }

    public function addAction()
    {
         $vendor = Ccc::getModel('Vendor');
         $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor);
        $content->addChild($vendorAdd);
        $this->renderLayout();
         //Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->toHtml(); 
        //Ccc::getBlock("vendor_Add")->toHtml();
    }

    public function editAction()
    {
         try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $vendor = Ccc::getModel('Vendor')->load($id);

            $vendor = $vendor->fetchRow("select c.*,a.* from vendor c join vendor_address a on a.vendorId = c.vendorId WHERE c.vendorId = {$id} ");
            
            if(!$vendor){
                throw new Exception("unable to load vendor.");
            }
         //Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->toHtml();
         $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor);
            $content->addChild($vendorEdit);
            $this->renderLayout();    
        
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    protected function saveVendor()
    {
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $row = $this->getRequest()->getRequest('vendor');
       // $vendorTable = Ccc::getModel('vendor_Resource'); 
        try 
        {

        $vendor = Ccc::getModel('Vendor');
    

        //$vendor = $vendorModel->getRow();

        date_default_timezone_set("Asia/Kolkata");
        $row = $this->getRequest()->getRequest('vendor');
        $date = date('Y-m-d H:i:s');
        //$vendor = $vendorModel->load($row['id']);
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
                $vendor->save();
                return $row['vendorId'];
        }
            } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','vendor',null,true));    
        }
    }




       /* $row = $this->getRequest()->getRequest('vendor');
       
        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }

        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $row = $this->getRequest()->getRequest('vendor');

        if (array_key_exists("vendorId", $row)) {

            if (!(int) $row["vendorId"]) {

                throw new Exception("Invalid Request.", 1);
            }

            $vendorId = $row["vendorId"];
            $query =  [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "mobile" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

            $update = $vendorTable->update($query,['vendorId' => $vendorId]);
            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {
           
            $vendorId = $vendorTable->insert($row);
            if (!$vendorId) {
                throw new Exception("System is unable to insert.", 1);
            }
        }    
        } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','vendor',null,true));    
        }
        

        return $vendorId;*/
                

    protected function saveAddress($vendorId)
    {
        /*date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $row = $this->getRequest()->getRequest('address');
        $addressModel = Ccc::getModel('vendor_Address'); 
        try 
        {
        $address = $addressModel->getRow();
        date_default_timezone_set("Asia/Kolkata");
        $row = $this->getRequest()->getRequest('address');
        print_r($row);
        exit();
        $date = date('Y-m-d H:i:s');
        //$address = $addressModel->load($row['id']);
        if(!array_key_exists('addressId',$row))
        {
                $address->vendorId = $row['vendorId'];
                $address->address =  $row['address'];
                $address->city =  $row['city'];
                $address->state =  $row['state'];
                $address->country =  $row['country'];
                $address->postalCode =  $row['postalCode'];
                $address->billing =  $row['billing'];
                $address->shipping =  $row['shipping'];
                $result = $address->save();
                return $result;

        }
        else{

                $address->vendorId = $row['vendorId'];
                $address->address =  $row['address'];
                $address->city =  $row['city'];
                $address->state =  $row['state'];
                $address->country =  $row['country'];
                $address->postalCode =  $row['postalCode'];
                $address->billing =  $row['billing'];
                $address->shipping =  $row['shipping'];
                $address->save();
                return $row['vendorId'];
        
        }
            } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','vendor',null,true));    
        }
    }*/

        //$addressTable = Ccc::getModel('Vendor_Address');
        $address = Ccc::getModel('Vendor_Address'); 
        try 
        {
        $row = $this->getRequest()->getRequest('address');
      /* print_r($row);
       exit();*/
        //$address = $addressModel->getRow();

        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        //$addressId = $row["addressId"];
       /* $billing = 2;
        $shipping = 2;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) {
            $shipping = 1;
        }*/
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
                
            
        }
        if (!$result) {
                throw new Exception("System is unable to insert", 1);
            }
        /*if ($addressData) {

                $query = ['vendorId' => $vendorId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ,"updatedAt" => $date];


            $update = $addressTable->update($query,['addressId' => $addressId]);

            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {

                $query = ['vendorId' => $vendorId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ];
                
            $result = $addressTable->insert($query);
            if (!$result) {
                throw new Exception("System is unable to insert", 1);
            }
        } */   
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','vendor',null,true));
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
            $getId = $this->getRequest()->getRequest('id');
        $vendorTable = Ccc::getModel('Vendor')->load($getId); 
        try {
            if (!isset($getId)) {
                throw new Exception("Invalid Request.", 1);
            }
            $delete = $vendorTable->delete(['vendorId' => $getId]);
            if (!$delete) {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect($this->getUrl('grid','vendor',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','vendor',null,true));
        }
    }
    public function errorAction()
    {
        echo "error";
    }
}
?>
