<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_salesman'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php
class Controller_salesman extends Controller_Core_Action
{

	public function gridAction()
	{
		$this->setTitle("Salesmana Grid");
		$content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("salesman_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();
	}

	 public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $salesManGrid = Ccc::getBlock('salesMan_Index');
        $content->addChild($salesManGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $salesManGrid = Ccc::getBlock("salesMan_Grid")->toHtml();
         $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         $response = [
            'status' => 'success',
            'content' => $salesManGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $salesMan = Ccc::getModel('salesMan');
        Ccc::register('salesMan',$salesMan);
        $customer = $salesMan->getCustomers();
        Ccc::register('customer',$customer);
        $salesManAdd =$this->getLayout()->getBlock('salesMan_Edit')->toHtml();
        $response = [
            'status' => 'success',
            'content' => $salesManAdd
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
            $salesManModel = Ccc::getModel('salesMan')->load($id);
            $salesMan = $salesManModel->fetchRow("SELECT * FROM `sales_man` WHERE `salesmanId` = $id");
            Ccc::register('salesMan',$salesMan);
            $customer = $salesManModel->getCustomers();
        	Ccc::register('customer',$customer);
        
            if(!$salesMan)
            {
                throw new Exception("unable to load salesMan.");
            }
            $content = $this->getLayout()->getContent();
            $salesManEdit = Ccc::getBlock("salesMan_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $salesManEdit
        ];
        $this->renderJson($response);
    }

	public function addAction()
	{
		$this->setTitle("Salesmana Add");
		$salesman = Ccc::getModel('salesman');
		$content = $this->getLayout()->getContent();
		Ccc::register('salesman',$salesman);
        $salesmanAdd = Ccc::getBlock("salesman_Edit");//->setData(['salesman' => $salesman]);
        $content->addChild($salesmanAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$this->setTitle("Salesmana Edit");
			$message = $this->getMessage();
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$salesman = Ccc::getModel('salesman')->load($id);
			if(!$salesman)
			{
				throw new Exception("unable to load salesman.");
			}
			Ccc::register('salesman',$salesman);	
			$content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock("salesman_Edit");//->setData(['salesman' => $salesman]);
            $content->addChild($salesmanEdit);
            $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,null,true);	;
		}
	}

	public function saveAction()
	{
		$message = $this->getMessage();
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		
		try
        {
            $row = $this->getRequest()->getPost('salesman');
            if (!$row) 
            {
            	//print_r("$this->redirect('addBlock',null,null,false)"); die;
                throw new Exception("Invalid Request.");             
            } 

            $salesmanId = (int)$this->getRequest()->getRequest('id');
            $salesman = Ccc::getModel('Salesman')->load($salesmanId);

            if(!$salesman)
            {
            	$salesman = Ccc::getModel('Salesman');
            	$salesman->setData($row);
               	$salesman->createdAt = $date;
            }
            else
            {
            	$salesman->setData($row);
            	$salesman->updatedAt = $date;
            }
            $result = $salesman->save();

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect('addBlock',null,['id' => $result->salesmanId , 'tab' => 'customer'],true);
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('grid','salesman',null,true);
        }

}
	
	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$salesmanTable = Ccc::getModel('salesman')->load($getId);
			if (!$getId) 
			{
				throw new Exception("Invalid Request.");
			}
			$delete = $salesmanTable->delete(['salesmanId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");
										
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect('grid','salesman',['id' => null],false);	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,['id' => null],false);	
		}
	}
}
