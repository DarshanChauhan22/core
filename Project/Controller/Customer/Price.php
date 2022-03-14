<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action 
{
    public function gridAction()
    {
        $this->setTitle("Price Grid");
        $content = $this->getLayout()->getContent();
        $customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
        $content->addChild($customerPriceGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            if (!$this->getRequest()->getPost('price')) 
            {
                throw new Exception("Invalid Request");
            }
            $postData = $this->getRequest()->getPost();
            $customerId = (int)$this->getRequest()->getRequest('customerId');
            if(array_key_exists('exists',$postData['price']))
            {
                foreach ($postData['price']['exists'] as $productId => $price) 
                {
                    $customerPrice = Ccc::getModel('Customer_Price')->fetchRow("SELECT * FROM customer_price WHERE customerId = {$customerId} AND productId = {$productId}");
                    $customerPrice->customerPrice = $price;
                    $result = $customerPrice->save();
                    if(!$result)
                    {
                        throw new Exception("Updated unsussfully.");
                    }
                }

            }
           
            if(array_key_exists('new', $postData['price']))
            {
                foreach ($postData['price']['new'] as $productId => $price) 
                {
                    $customerPrice = Ccc::getModel('Customer_Price');
                    $customerPrice->productId = $productId;
                    $customerPrice->customerId = $customerId;
                    $customerPrice->customerPrice = $price;
                    $customerPrice->save();
                }
            }

            $salesmanId = (int)$this->getRequest()->getRequest('id');
            $message->addMessage('Update successfully.');
            $this->redirect($this->getUrl('grid',null,['id'=>$salesmanId,'customerId'=>$customerId],true));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid'));
        }


    }
    
}