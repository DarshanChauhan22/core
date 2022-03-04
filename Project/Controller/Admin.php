<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Admin extends Controller_Core_Action{
	
	public function testAction()
	{
		/*echo "<pre>";
		$m = Ccc::getModel('Core_Message');
		//print_r($m);
		$m->addMessage('dom');
		$m->addMessage('paul',Model_Core_Message::ERROR);
		//$m->unsetMessage();
		$m->addMessage('tez',Model_Core_Message::WARNING);
		$m->addMessage('roman',Model_Core_Message::WARNING);
		$this->redirect($this->getUrl('testt'));
		print_r($m->getMessages());*/
		//exit;

		/*$s = Ccc::getModel('Core_Session');
		print_r($s->getId());
		$s->destroy();
		print_r($s->getId());
		exit();*/
        /*$adminTable = new Model_Admin(); 
		$adminTable->setTableName('admin');
		$adminTable->setPrimaryKey('adminId');*/
		/*$message = Ccc::getModel('Core_Message');
		$message->addMessage('Grid Show Successfully.');
		$message->unsetMessage();*/
	}

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$admin = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock("Admin_Edit")->addData("admin", $admin);
        $content->addChild($adminAdd);
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
			$admin = Ccc::getModel('Admin')->load($id);
			if(!$admin)
			{	
				$message->addMessage('Unable To Load Admin.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
			}

			$content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit")->addData("admin", $admin);
            $content->addChild($adminEdit);
            $this->renderLayout();	
           

		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}
	
	public function saveAction()
	{
		try
		{
			$message = Ccc::getModel('Core_Message');
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			$admin = Ccc::getModel('Admin');
			$row = $this->getRequest()->getRequest('admin');

			if (!isset($row)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('adminId',$row) && $row['adminId'] == null)
       		 {
                $admin->firstName = $row['firstName'];
                $admin->lastName =  $row['lastName'];
                $admin->email =  $row['email'];
                $admin->password =  $row['password'];
                $admin->status =  $row['status'];
                $admin->createdAt =  $date;
                $result = $admin->save();

                if(!$result)
                {
                	$message->addMessage('Insert Unsuccessfully.',Model_Core_Message::ERROR);
                	$this->redirect($this->getUrl('grid',null,null,true));
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{

                $admin->load($row['adminId']);
                $admin->adminId = $row["adminId"];
                $admin->firstName = $row['firstName'];
                $admin->lastName =  $row['lastName'];
                $admin->email =  $row['email'];
                $admin->password =  $row['password'];
                $admin->status =  $row['status'];
                $admin->updatedAt =  $date;
                $result = $admin->save();

                if(!$result)
                {
				$message->addMessage('Update Unsuccessfully.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));
                }
				$message->addMessage('Update Successfully.');
       		}
			$this->redirect($this->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('grid',null,null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$getId = $this->getRequest()->getRequest('id'); 
			$adminTable = Ccc::getModel('Admin')->load($getId);	
			if (!isset($getId)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);
				$this->redirect($this->getUrl('grid',null,null,true));	
				//throw new Exception("Invalid Request.", 1);
			}
			$delete = $adminTable->delete(['adminId' => $getId]);
			if(!$delete)
			{
				$message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);			
				$this->redirect($this->getUrl('grid',null,null,true));
				//throw new Exception("System is unable to delete record.", 1);
										
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect($this->getUrl('grid',null,null,true));			
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('grid',null,null,true));	
		}
	}

}
?>