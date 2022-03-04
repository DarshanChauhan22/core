<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_SalesMan');
Ccc::loadClass('Model_Core_Request');

class Controller_SalesMan extends Controller_Core_Action{
	
	public function testAction()
	{
		$salesManTable = new Model_SalesMan(); 
		$salesManTable->setTableName('salesMan');
		$salesManTable->setPrimaryKey('salesManId');
	}
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $salesManGrid = Ccc::getBlock("SalesMan_Grid");
        $content->addChild($salesManGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$salesMan = Ccc::getModel('SalesMan');
		$content = $this->getLayout()->getContent();
        $salesManAdd = Ccc::getBlock("SalesMan_Edit")->addData("salesMan", $salesMan);
        $content->addChild($salesManAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				$message->addMessage('Id not valid.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("Id not valid.");
			}
			$salesMan = Ccc::getModel('SalesMan')->load($id);
			if(!$salesMan)
			{
				$message->addMessage('Unable To Load Admin.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("unable to load salesMan.");
			}
				
			$content = $this->getLayout()->getContent();
            $salesManEdit = Ccc::getBlock("SalesMan_Edit")->addData("salesMan", $salesMan);
            $content->addChild($salesManEdit);
            $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}
	
	public function saveAction()
	{
		$message = Ccc::getModel('Core_Message');
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		try
		{
			$salesMan = Ccc::getModel('SalesMan');

			$row = $this->getRequest()->getRequest('salesMan');
			if (!isset($row)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('salesManId',$row) && $row['salesManId'] == null)
       		 {
                $salesMan->firstName = $row['firstName'];
                $salesMan->lastName =  $row['lastName'];
                $salesMan->email =  $row['email'];
                $salesMan->mobile =  $row['mobile'];
                $salesMan->status =  $row['status'];
                $salesMan->createdAt =  $date;
                $salesMan->updatedAt =  null;
                $result = $salesMan->save();

                if(!$result)
                {
                	$message->addMessage('Insert Unsuccessfully.',Model_Core_Message::ERROR);
                	$this->redirect($this->getUrl('grid',null,null,true));
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{

                $salesMan->load($row['salesManId']);
                $salesMan->salesManId = $row["salesManId"];
                $salesMan->firstName = $row['firstName'];
                $salesMan->lastName =  $row['lastName'];
                $salesMan->email =  $row['email'];
                $salesMan->mobile =  $row['mobile'];
                $salesMan->status =  $row['status'];
                $salesMan->updatedAt =  $date;
                $result = $salesMan->save();

                if(!$result)
                {
				$message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
                }
				$message->addMessage('Update Successfully.');
       			}

			$this->redirect($this->getUrl('grid','salesMan',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','salesMan',null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = Ccc::getModel('Core_Message');
			$getId = $this->getRequest()->getRequest('id'); 
			$salesManTable = Ccc::getModel('SalesMan')->load($getId);
			if (!isset($getId)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("Invalid Request.", 1);
			}
			$delete = $salesManTable->delete(['salesManId' => $getId]);
			if(!$delete)
			{
				$message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);			
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("System is unable to delete record.", 1);
										
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect($this->getUrl('grid','salesMan',null,true));	
				
		} catch (Exception $e) 
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('grid','salesMan',null,true));	
		}
	}
}
?>