<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Customer_Grid")->toHtml();
        /*$customerModel = Ccc::getModel('Customer');
        echo "<pre>";
        //print_r($customerModel);
        $customer = $customerModel->getRow();
        print_r($customer);
        $customer->customerId = '146';
        $customer->firstName = 'dc';
        $customer->lastName = 'dc';
        $customer->mobile = '900000';
        $customer->status = '1';
        //$customer = $customerModel->load(146);
        $customer->lastName = 'dc';
        unset($customer->lastName);
        //print_r($customer);
        print_r($customer);
        $customer->save();*/
    }

    public function addAction()
    {
        Ccc::getBlock("Customer_Add")->toHtml();
    }

    public function editAction()
    {
         try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $customerModel = Ccc::getModel('Customer_Resource');

            $customer = $customerModel->fetchRow("select c.*,a.* from customer c join address a on a.customerId = c.customerId WHERE c.customerId = {$id} ");
            
            if(!$customer){
                throw new Exception("unable to load customer.");
            }
         Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->toHtml();  
        
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    protected function saveCustomer()
    {
        global $date;
        $row = $this->getRequest()->getRequest('customer');
        $customerTable = Ccc::getModel('Customer_Resource'); 
        try 
        {

        $customerModel = Ccc::getModel('Customer_Resource');
    

        $customer = $customerModel->getRow();

        date_default_timezone_set("Asia/Kolkata");
        $row = $this->getRequest()->getRequest('customer');
        $date = date('Y-m-d H:i:s');
        //$customer = $customerModel->load($row['id']);
        if(!array_key_exists('customerId',$row))
        {
                $customer->firstName = $row['firstName'];
                $customer->lastName =  $row['lastName'];
                $customer->email =  $row['email'];
                $customer->mobile =  $row['mobile'];
                $customer->status =  $row['status'];
                $result = $customer->save();
                return $result;

        }
        else{

                $customer = $customerModel->load($row['customerId']);
                $customer->firstName = $row['firstName'];
                $customer->lastName =  $row['lastName'];
                $customer->email =  $row['email'];
                $customer->mobile =  $row['mobile'];
                $customer->status =  $row['status'];
                $customer->updatedAt =  $date;
                $customer->save();
                return $row['customerId'];
        
        }
            } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','customer',null,true));    
        }
    }




       /* $row = $this->getRequest()->getRequest('customer');
       
        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }

        global $date;
        $row = $this->getRequest()->getRequest('customer');

        if (array_key_exists("customerId", $row)) {

            if (!(int) $row["customerId"]) {

                throw new Exception("Invalid Request.", 1);
            }

            $customerId = $row["customerId"];
            $query =  [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "mobile" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

            $update = $customerTable->update($query,['customerId' => $customerId]);
            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {
           
            $customerId = $customerTable->insert($row);
            if (!$customerId) {
                throw new Exception("System is unable to insert.", 1);
            }
        }    
        } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','customer',null,true));    
        }
        

        return $customerId;*/
                

    protected function saveAddress($customerId)
    {
        /*global $date;
        $row = $this->getRequest()->getRequest('address');
        $addressModel = Ccc::getModel('Customer_Address'); 
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
                $address->customerId = $row['customerId'];
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

                $address->customerId = $row['customerId'];
                $address->address =  $row['address'];
                $address->city =  $row['city'];
                $address->state =  $row['state'];
                $address->country =  $row['country'];
                $address->postalCode =  $row['postalCode'];
                $address->billing =  $row['billing'];
                $address->shipping =  $row['shipping'];
                $address->save();
                return $row['customerId'];
        
        }
            } catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','customer',null,true));    
        }
    }*/

        //$addressTable = Ccc::getModel('Customer_Address');
        $addressModel = Ccc::getModel('Customer_Address_Resource'); 
        try 
        {
        $row = $this->getRequest()->getRequest('address');
       
        $address = $addressModel->getRow();

        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }
        global $date;
        //$addressId = $row["addressId"];
        $billing = 2;
        $shipping = 2;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) {
            $shipping = 1;
        }
        $addressData = $addressModel->fetchRow(
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
                

        }
        else{
                $address = $addressModel->load($row['addressId']);
                $address->customerId = $customerId;
                $address->address =  $row['address'];
                $address->city =  $row['city'];
                $address->state =  $row['state'];
                $address->country =  $row['country'];
                $address->postalCode =  $row['postalCode'];
                $address->billing =  $row['billing'];
                $address->shipping =  $row['shipping'];
                $address->updatedAt =  $date;
                $result = $address->save();
        
        }
        if (!$result) {
                throw new Exception("System is unable to insert", 1);
            }
        /*if ($addressData) {

                $query = ['customerId' => $customerId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ,"updatedAt" => $date];


            $update = $addressTable->update($query,['addressId' => $addressId]);

            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {

                $query = ['customerId' => $customerId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ];
                
            $result = $addressTable->insert($query);
            if (!$result) {
                throw new Exception("System is unable to insert", 1);
            }
        } */   
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','customer',null,true));
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
        $customerTable = Ccc::getModel('Customer_Resource'); 
        try {
            $getId = $this->getRequest()->getRequest('id');
            if (!isset($getId)) {
                throw new Exception("Invalid Request.", 1);
            }
            $delete = $customerTable->delete(['customerId' => $getId]);
            if (!$delete) {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect($this->getUrl('grid','customer',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','customer',null,true));
        }
    }
    public function errorAction()
    {
        echo "error";
    }
}
?>
