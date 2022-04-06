<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_Admin extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$this->setTitle("Admin Grid");
		$content = $this->getLayout()->getContent();

        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
        $this->renderLayout();
	}

	public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $adminGrid = Ccc::getBlock('Admin_Index');
        $content->addChild($adminGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $adminGrid = Ccc::getBlock("admin_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         //$messageBlock->addMessage('hiiiiiiii');
         $response = [
            'status' => 'success',
            'content' => $adminGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $admin = Ccc::getModel('Admin');
        Ccc::register('admin',$admin);
        $adminAdd = $this->getLayout()->getBlock('Admin_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $adminAdd
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
            $adminModel = Ccc::getModel('admin')->load($id);
            $admin = $adminModel->fetchRow("SELECT * FROM `admin` WHERE `adminId` = $id");

            
            if(!$admin)
            {
                throw new Exception("unable to load admin.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('admin',$admin);
           
            $adminEdit = Ccc::getBlock("admin_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $adminEdit
         ] ;
        $this->renderJson($response);
    }


	public function addAction()
	{
		$this->setTitle("Admin Add");
		$admin = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
		Ccc::register('admin',$admin);
        $adminAdd = Ccc::getBlock("Admin_Edit");//->setData(['admin' => $admin]);
        $content->addChild($adminAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$this->setTitle("Admin Edit");
			$message = $this->getMessage();
			
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$admin = Ccc::getModel('Admin')->load($id);
			if(!$admin)
			{	
				throw new Exception("Unable To Load Admin.");
			}
			Ccc::register('admin',$admin);
			$content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit");//->setData(['admin' => $admin]);
            $content->addChild($adminEdit);
            $this->renderLayout();	
           

		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,['id' => null],false);
		}
	}
	
	public function saveAction()
	{
		try
		{
			$message = $this->getMessage();
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			$admin = Ccc::getModel('Admin');
			$row = $this->getRequest()->getRequest('admin');

			if (!$row) 
			{
				throw new Exception("Invalid Request.");				
			}			


			 if(array_key_exists('adminId',$row) && $row['adminId'] == null)
       		 {
                $admin->firstName = $row['firstName'];
                $admin->lastName =  $row['lastName'];
                $admin->email =  $row['email'];
                $admin->password =  md5($row['password']);
               	$admin->status =  $row['status'];
                $admin->createdAt =  $date;
                $result = $admin->save();

                if(!$result)
                {
                	throw new Exception("Insert Unsuccessfully.");
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{
        		$admin->setData($row);
                $admin->updatedAt =  $date;
                $result = $admin->save();

                if(!$result)
                {
                	throw new Exception("Update Unsuccessfully.");
                }
				$message->addMessage('Update Successfully.');
       		}
			$this->redirect('gridBlock',null,['id' => null],false);
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('grid',null,['id' => null],false);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$this->setTitle("Admin Delete");
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$adminTable = Ccc::getModel('Admin')->load($getId);	
			if (!$getId) 
			{	
				throw new Exception("Invalid Request.");
			}
			$delete = $adminTable->delete(['adminId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");						
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect('gridBlock',null,['id' => null],false);			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('gridBlock',null,['id' => null],false));	
		}
	}

}
