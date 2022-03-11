<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_salesman');
Ccc::loadClass('Model_Core_Request');

class Controller_salesman extends Controller_Core_Action{
	
	public function testAction()
	{
		$salesmanTable = new Model_salesman(); 
		$salesmanTable->setTableName('salesman');
		$salesmanTable->setPrimaryKey('salesmanId');
	}
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("salesman_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$salesman = Ccc::getModel('salesman');
		$content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock("salesman_Edit")->addData("salesman", $salesman);
        $content->addChild($salesmanAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
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
				
			$content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock("salesman_Edit")->addData("salesman", $salesman);
            $content->addChild($salesmanEdit);
            $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));	;
		}
	}
	
	public function saveAction()
	{
		$message = $this->getMessage();
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		try
		{
			$salesman = Ccc::getModel('salesman');

			$row = $this->getRequest()->getRequest('salesman');
			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('salesmanId',$row) && $row['salesmanId'] == null)
       		 {
                $salesman->firstName = $row['firstName'];
                $salesman->lastName =  $row['lastName'];
                $salesman->email =  $row['email'];
                $salesman->mobile =  $row['mobile'];
                $salesman->status =  $row['status'];
                $salesman->percentage =  $row['percentage'];
                $salesman->createdAt =  $date;
                $salesman->updatedAt =  null;
                $result = $salesman->save();

                if(!$result)
                {
                	throw new Exception("Insert Unsuccessfully.",1);
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{

                $salesman->load($row['salesmanId']);
                $salesman->salesmanId = $row["salesmanId"];
                $salesman->firstName = $row['firstName'];
                $salesman->lastName =  $row['lastName'];
                $salesman->email =  $row['email'];
                $salesman->mobile =  $row['mobile'];
                $salesman->status =  $row['status'];
                $salesman->percentage =  $row['percentage'];
                $salesman->updatedAt =  $date;
                $result = $salesman->save();

                if(!$result)
                {
					throw new Exception("Update Unsuccessfully.",1);
                }
				$message->addMessage('Update Successfully.');
       			}

			$this->redirect($this->getUrl('grid','salesman',null,true));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));	
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$salesmanTable = Ccc::getModel('salesman')->load($getId);
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $salesmanTable->delete(['salesmanId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect($this->getUrl('grid','salesman',null,true));	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));	
		}
	}
}
?>