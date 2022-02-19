<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");
Ccc::loadClass('Model_Product');
class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Customer_Grid")->toHtml();
        /*
        global $adapter; 
        $query = "SELECT 
                    * 
                FROM customer";
        $query2 = "SELECT address 
                FROM customer c 
                    JOIN  
                address a ON c.customerId = a.customerId";

                
        $customer = $adapter-> fetchAll($query);
        $address = $adapter-> fetchAll($query2);
        
        $view = $this->getView();
        
        $view->setTemplate('view/customer/grid.php');
        $view->addData('customer',$customer);
        $view->addData('address',$address);
        $view->toHtml();
        //require_once('view/customer/grid.php');*/
    }

    public function addAction()
    {
        Ccc::getBlock("Customer_Add")->toHtml();
        /*
        $view = $this->getView();
        
        $view->setTemplate('view/customer/add.php')->toHtml();
        
        //require_once('view/customer/add.php');
        */
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

        /*
        global $adapter;
        $request = new Model_Core_Request();
        $getId = $request->getRequest('id');
        $query = "SELECT * FROM Customer  
               WHERE customerId=".$getId;
        $customer = $adapter-> fetchRow($query);
        $query2 = "SELECT 
                  a.* 
                FROM 
              address a 
                JOIN 
              customer c ON a.customerId = c.customerId WHERE a.customerId =".$getId;  
        $address = $adapter-> fetchRow($query2);
        $view = $this->getView();
        
        $view->setTemplate('view/customer/edit.php');
        $view->addData('customer',$customer);
        $view->addData('address',$address);
        $view->toHtml();
        */
        //require_once('view/customer/edit.php');
    }
    protected function saveCustomer()
    {
        
        $customerTable = Ccc::getModel('Customer'); 
        try 
        {
            //$request = new Model_Core_Request();
        $row = $this->getRequest()->getRequest('customer');
       

        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }

        global $adapter;
        global $date;
        $row = $this->getRequest()->getRequest('customer');

        if (array_key_exists("customerId", $row)) {

            if (!(int) $row["customerId"]) {

                throw new Exception("Invalid Request.", 1);
            }

            $customerId = $row["customerId"];
           /* $query =
                "UPDATE customer 
                SET firstName='" .
                $row["firstName"] .
                "',
                    lastName='" .
                $row["lastName"] .
                "',
                    email='" .
                $row["email"] .
                "',
                    mobile='" .
                $row["mobile"] .
                "',
                    status='" .
                $row["status"] .
                "',
                    updatedAt='" .
                $date .
                "' 
                WHERE customerId='" .
                $customerId .
                "'";*/

            $update = $customerTable->update($row,['customerId' => $customerId]);
            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {
            /*$query =
                "INSERT INTO Customer(firstName,lastName,email,mobile,status,createdAt)     VALUES('" .
                $row["firstName"] .
                "',
                       '" .
                $row["lastName"] .
                "',
                       '" .
                $row["email"] .
                "',
                       '" .
                $row["mobile"] .
                "',
                       '" .
                $row["status"] .
                "',
                       '" .
                $date .
                "')";*/
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
             //$request = new Model_Core_Request();
        $row = $this->getRequest()->getRequest('address');

        if (!isset($row)) {
            throw new Exception("Invalid Request.", 1);
        }
        global $adapter;
        //$row = $_POST['address'];
        $addressId = $row["addressId"];
        $billing = 2;
        $shipping = 2;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) {
            $shipping = 1;
        }
        $addressData = $adapter->fetchRow(
            "SELECT * FROM address WHERE customerId = $customerId"
        );

        if ($addressData) {
            $query =
               /* "UPDATE address 
                SET address='" .
                $row["address"] .
                "',
                    city='" .
                $row["city"] .
                "',
                    state='" .
                $row["state"] .
                "',
                    country='" .
                $row["country"] .
                "',
                    postalCode='" .
                $row["postalCode"] .
                "',
                    billing='" .
                $billing .
                "',
                    shipping='" .
                $shipping .
                "'
                WHERE customerId='" .
                $customerId .
                "'";*/

                $query = ['customerId' => $customerId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ];


            $update = $addressTable->update($query,['addressId' => $addressId]);

            if (!$update) {
                throw new Exception("System is unable to update.", 1);
            }
        } else {
            /*$query =
                "INSERT INTO address(customerId,address,city,state,country,postalCode,billing,shipping)         
                VALUES($customerId,
                       '" .
                $row["address"] .
                "',
                       '" .
                $row["city"] .
                "',
                       '" .
                $row["state"] .
                "',
                       '" .
                $row["country"] .
                "',
                       '" .
                $row["postalCode"] .
                "',
                       '" .
                $billing .
                "',
                       '" .
                $shipping .
                "')";*/

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
        //$request = new Model_Core_Request();
        try {
            $getId = $this->getRequest()->getRequest('id');
            if (!isset($getId)) {
                throw new Exception("Invalid Request.", 1);
            }

           // global $adapter;
            //$id=$_GET['id'];
           // $query = "DELETE FROM Customer WHERE customerId = " . $getId;
            $delete = $customerTable->delete(['customerId' => $getId]);
            if (!$delete) {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect($this->getUrl('grid','customer',null,true));
        } catch (Exception $e) {
            $this->redirect($this->getUrl('grid','customer',null,true));
            //echo $e->getMessage();
        }
    }
    public function errorAction()
    {
        echo "error";
    }
}
?>
