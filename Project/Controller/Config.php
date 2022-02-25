<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Config');
Ccc::loadClass('Model_Core_Request');

class Controller_Config extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Config_grid')->toHtml();	
	}

	public function addAction()
	{
		Ccc::getBlock('Config_Add')->toHtml();
	}

	public function editAction()
	{	
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$config = Ccc::getModel('Config')->load($id);
			//$config = $configModel->fetchRow("SELECT * FROM config WHERE configId = {$id} ");
			if(!$config){
				throw new Exception("unable to load config.");
			}
			Ccc::getBlock('Config_Edit')->addData('config',$config)->toHtml();	
				
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}
	
	public function saveAction()
	{
		global $date;
		//$configTable = Ccc::getModel('Config_Resource');
		try
		{
			$config = Ccc::getModel('Config');

       		//$config = $configModel->getRow();
			$row = $this->getRequest()->getRequest('config');

			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
			}			


			 if(!array_key_exists('configId',$row))
       		 {
                $config->name = $row['name'];
                $config->code =  $row['code'];
                $config->value =  $row['value'];
                $config->status =  $row['status'];
                $config->createdAt =  $date;
                $config->save();
        	}
        	else
        	{

                $config->load($row['configId']);
                $config->configId = $row["configId"];
                $config->name = $row['name'];
                $config->code =  $row['code'];
                $config->value =  $row['value'];
                $config->status =  $row['status'];
                $config->save();
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
		$configTable = Ccc::getModel('Config_Resource');
		try 
		{	
			$getId = $this->getRequest()->getRequest('id'); 
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $configTable->delete(['configId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$rd = $this->getUrl('grid','config');
			echo $rd;
			
			$this->redirect($this->getUrl('grid','config',null,true));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','config',null,true));	
		}
	}
	
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>