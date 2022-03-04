<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Config');
Ccc::loadClass('Model_Core_Request');

class Controller_Config extends Controller_Core_Action{
	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock("Config_Grid");
        $content->addChild($configGrid);
        $this->renderLayout();			
	}

	public function addAction()
	{
		$config = Ccc::getModel('Config');
		$content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock("Config_Edit")->addData("config", $config);
        $content->addChild($configAdd);
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
			$config = Ccc::getModel('Config')->load($id);
			if(!$config)
			{
				$message->addMessage('Unable To Load Grid.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("unable to load config.");
			}
			
			$content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock("Config_Edit")->addData("config", $config);
            $content->addChild($configEdit);
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
			$config = Ccc::getModel('Config');

			$row = $this->getRequest()->getRequest('config');
			print_r($row);
			if (!isset($row)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid'));
				//throw new Exception("Invalid Request.", 1);				
			}			

			 if(array_key_exists('configId',$row) && $row['configId'] == null)
       		 {
                $config->name = $row['name'];
                $config->code =  $row['code'];
                $config->value =  $row['value'];
                $config->status =  $row['status'];
                $config->createdAt =  $date;
                $result = $config->save();

             if(!$result)
                {
                $message->addMessage('Insert Unsuccessfully.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid',null,null,true));
                }
				$message->addMessage('Insert Successfully.');
        	}
        	else
        	{

                $config->load($row['configId']);
                $config->configId = $row["configId"];
                $config->name = $row['name'];
                $config->code =  $row['code'];
                $config->value =  $row['value'];
                $config->status =  $row['status'];
                $result = $config->save();

                if(!$result)
                {
				$message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
                }
				$message->addMessage('Update Successfully.');
       		}

			$this->redirect($this->getUrl('grid','config',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','config',null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = Ccc::getModel('Core_Message');
			$getId = $this->getRequest()->getRequest('id'); 
			$configTable = Ccc::getModel('Config')->load($getId);
			if (!isset($getId)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid'));	
				//throw new Exception("Invalid Request.", 1);
			}
			$delete = $configTable->delete(['configId' => $getId]);
			if(!$delete)
			{
				$message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);			
				$this->redirect($this->getUrl('grid'));	
				//throw new Exception("System is unable to delete record.", 1);
										
			}
			$message->addMessage('Delete Successfully.');	
			$this->redirect($this->getUrl('grid','config',null,true));	
				
		} catch (Exception $e) 
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('grid','config',null,true));	
		}
	}
	
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>