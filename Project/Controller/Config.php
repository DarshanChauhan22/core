<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Config'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php
class Controller_Config extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$this->setTitle("Config Grid");
		$content = $this->getLayout()->getContent();
      $configGrid = Ccc::getBlock("Config_Grid");
      $content->addChild($configGrid);
      $this->renderLayout();			
	}

	public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $configGrid = Ccc::getBlock('Config_Index');
        $content->addChild($configGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $configGrid = Ccc::getBlock("Config_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         //$messageBlock->addMessage('hiiiiiiii');
         $response = [
            'status' => 'success',
            'content' => $configGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $config = Ccc::getModel('config');
        Ccc::register('config',$config);
        $configAdd = $this->getLayout()->getBlock('Config_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $configAdd
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
            $configModel = Ccc::getModel('config')->load($id);
            $config = $configModel->fetchRow("SELECT * FROM `config` WHERE `configId` = $id");

            
            if(!$config)
            {
                throw new Exception("unable to load config.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('config',$config);
           
            $configEdit = Ccc::getBlock("config_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $configEdit
         ] ;
        $this->renderJson($response);
    }


	public function addAction()
	{
		$this->setTitle("Customer Add");
		$config = Ccc::getModel('Config');
		$content = $this->getLayout()->getContent();
		Ccc::register('config',$config);
	   $configAdd = Ccc::getBlock("Config_Edit");//->setData(['config' => $config]);
	   $content->addChild($configAdd);
	   $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$this->setTitle("Customer Edit");
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
			Ccc::register('config',$config);
			$content = $this->getLayout()->getContent();
         $configEdit = Ccc::getBlock("Config_Edit");//->setData(['config' => $config]);
         $content->addChild($configEdit);
         $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}
	
	public function saveAction()
	{
		$message = $this->getMessage();
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		
		try
        {
            $row = $this->getRequest()->getPost('config');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 

            $configId = (int)$this->getRequest()->getRequest('id');
            $config = Ccc::getModel('Config')->load($configId);

            if(!$config)
            {
               $config = Ccc::getModel('Config');
            	$config->setData($row);
               $config->createdAt = $date;
            }
            else
            {
            	$config->setData($row);
            }
            $result = $config->save();

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect('gridBlock','config',['id' => null],false);
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('gridBlock','config',['id' => null],false);
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
			$this->redirect('gridBlock','config',['id' => null],false);	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('gridBlock',null,['id' => null],false);
		}
	}
}
