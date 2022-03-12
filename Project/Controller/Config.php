<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Config'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php
class Controller_Config extends Controller_Core_Action
{
	
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
	   $configAdd = Ccc::getBlock("Config_Edit")->setData(['config' => $config]);
	   $content->addChild($configAdd);
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
			$config = Ccc::getModel('Config')->load($id);
			if(!$config)
			{
				throw new Exception("unable to load config.");
			}
			
			$content = $this->getLayout()->getContent();
         $configEdit = Ccc::getBlock("Config_Edit")->setData(['config' => $config]);
         $content->addChild($configEdit);
         $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));
		}
	}
	
	public function saveAction()
	{
		$message = $this->getMessage();
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		try
		{
			$config = Ccc::getModel('Config');

			$row = $this->getRequest()->getRequest('config');
			print_r($row);
			if (!$row) 
			{
				throw new Exception("Invalid Request.");				
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
                	throw new Exception("Insert Unsuccessfully.");
                }
					$message->addMessage('Insert Successfully.');
	        	}
	        	else
	        	{	
	        		$config->setData($row);
               $result = $config->save();

               if(!$result)
               {
						throw new Exception("Update Unsuccessfully.");
             	}
				$message->addMessage('Update Successfully.');
       		}

			$this->redirect($this->getUrl('grid','config',null,true));
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
			$configTable = Ccc::getModel('Config')->load($getId);
			if (!$getId) 
			{	
				throw new Exception("Invalid Request.");
			}
			$delete = $configTable->delete(['configId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");
										
			}
			$message->addMessage('Delete Successfully.');	
			$this->redirect($this->getUrl('grid','config',null,true));	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));
		}
	}
}
