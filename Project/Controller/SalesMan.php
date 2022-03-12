<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_salesman'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php
class Controller_salesman extends Controller_Core_Action
{
	
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
        $salesmanAdd = Ccc::getBlock("salesman_Edit")->setData(['salesman' => $salesman]);
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
            $salesmanEdit = Ccc::getBlock("salesman_Edit")->setData(['salesman' => $salesman]);
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
			if (!$row) 
			{
				throw new Exception("Invalid Request.");				
			}			


			 if(array_key_exists('salesmanId',$row) && $row['salesmanId'] == null)
       		 {
       		 	$salesman = Ccc::getModel('Salesman');
                $salesman->createdAt =  $date;
                $result = $salesman->save();

                if(!$result)
                {
                	throw new Exception("Insert Unsuccessfully.");
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{
        		$salesman->setData($row);
                $salesman->updatedAt =  $date;
                $result = $salesman->save();

                if(!$result)
                {
					throw new Exception("Update Unsuccessfully.");
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
			$this->redirect($this->getUrl('grid','salesman',null,true));	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));	
		}
	}
}
