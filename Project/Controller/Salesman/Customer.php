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

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $salesManCustomerGrid = Ccc::getBlock('SalesMan_Customer_Index');
        $content->addChild($salesManCustomerGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $salesManCustomerGrid = Ccc::getBlock("SalesMan_Customer_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         //$messageBlock->addMessage('hiiiiiiii');
         $response = [
            'status' => 'success',
            'content' => $salesManCustomerGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $salesManCustomer = Ccc::getModel('SalesMan_Customer');
        Ccc::register('salesManCustomer',$salesManCustomer);
        $salesManCustomerAdd = $this->getLayout()->getBlock('SalesMan_Customer_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $salesManCustomerAdd
         ];
        $this->renderJson($response);
    }

   
    public function editBlockAction()
    {

        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $salesManCustomerModel = Ccc::getModel('salesManCustomer')->load($id);
            $salesManCustomer = $salesManCustomerModel->fetchRow("SELECT * FROM `customer_price` WHERE `customerId` = $id");

            
            if(!$salesManCustomer)
            {
                throw new Exception("unable to load salesManCustomer.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('salesManCustomer',$salesManCustomer);
           
            $salesManCustomerEdit = Ccc::getBlock("SalesMan_Customer_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $salesManCustomerEdit
         ] ;
        $this->renderJson($response);
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
                $this->redirect('gridBlock',null,null,false);
                
            
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect('gridBlock',null,null,false);  
        }
    }

}