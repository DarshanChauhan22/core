<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");
Ccc::loadClass('Model_Product');
class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Customer_Grid")->toHtml();
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
            $customerModel = Ccc::getModel('customer');

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
        
        $customerTable = Ccc::getModel('Customer'); 
        try 
        {
        $row = $this->getRequest()->getRequest('customer');
       
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
        

        return $customerId;
    }

    protected function saveAddress($customerId)
    {
        $addressTable = Ccc::getModel('Customer_Address');
        try 
        {
        $row = $this->getRequest()->getRequest('address');

        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }
        global $date;
        $addressId = $row["addressId"];
        $billing = 2;
        $shipping = 2;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) {
            $shipping = 1;
        }
        $addressData = $addressTable->fetchRow(
            "SELECT * FROM address WHERE customerId = $customerId"
        );

        if ($addressData) {

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
        }    
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
        $customerTable = Ccc::getModel('Customer'); 
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
