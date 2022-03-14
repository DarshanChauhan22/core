<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle("Customer Grid");
        $content = $this->getLayout()->getContent();
        $salesmanCustomerGrid = Ccc::getBlock('salesman_Customer_Grid');
        $content->addChild($salesmanCustomerGrid);
        $this->renderLayout();
    }

    public function saveAction() 

    {
        try {
            $message = $this->getMessage();
            date_default_timezone_set("Asia/Kolkata");
            $date = date("Y-m-d H:i:s");
            $message = $this->getMessage();
            $customer = Ccc::getModel('Customer');
            $row =  $this->getRequest()->getRequest('salesmanCustomer');

            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            }

            $customerIds = $row["customerNo"];
               
                $result = $customer->saveCustomer($customerIds);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully");   
                }
                $message->addMessage('Update Successfully.');
                $this->redirect($this->getUrl('grid','salesman_Customer',null,false));
                
            
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid',null,null,true));  
        }
    }

}