<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
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

            if (!isset($row)) 
            {
                throw new Exception("Invalid Request.", 1);             
            }

            $customerIds = $row["customerNo"];
               
                $result = $customer->saveCustomer($customerIds);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully", 1);   
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