<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');

class Controller_Admin extends Controller_Core_Action{
	
	public function testAction()
	{
		$adminTable = new Model_Admin(); 
		$adminTable->setTableName('admin');
		$adminTable->setPrimaryKey('adminId');
	}
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
        $this->renderLayout();
		//$this->randerLayout();
		//Ccc::getBlock('Admin_grid')->toHtml();	
	}

	public function addAction()
	{
		$admin = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock("Admin_Edit")->addData("admin", $admin);
        $content->addChild($adminAdd);
        $this->renderLayout();	
		//Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();	
		//Ccc::getBlock('Admin_Add')->toHtml();
	}

	public function editAction()
	{	
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$admin = Ccc::getModel('Admin')->load($id);
			//$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE adminId = {$id} ");
			if(!$admin){
				throw new Exception("unable to load admin.");
			}
			//Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();	
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
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		//$adminTable = Ccc::getModel('Admin_Resource');
		try
		{
			//$id = (int) $this->getRequest()->getRequest('admimId');
			$admin = Ccc::getModel('Admin');

       		//$admin = $adminModel->getRow();
			$row = $this->getRequest()->getRequest('admin');

			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('adminId',$row) && $row['adminId'] == null)
       		 {
                $admin->firstName = $row['firstName'];
                $admin->lastName =  $row['lastName'];
                $admin->email =  $row['email'];
                $admin->password =  $row['password'];
                $admin->status =  $row['status'];
                $admin->createdAt =  $date;
                $admin->save();
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
                $admin->save();
       			}


			/*if (array_key_exists('adminId', $row)) {
				if(!(int)$row['adminId']){
					throw new Exception("Invalid Request.", 1);
				}
				$adminId = $row["adminId"];

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "password" => $row['password'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];
				
				$update=$adminTable->update($query,['adminId' => $adminId]);

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "password" => $row['password'],
                    "mobile=" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

				$update = $adminTable->update($query , ['adminId' => $adminId]);

				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				
				$adminId = $adminTable->insert($row);
				if(!$adminId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}*/
			$this->redirect($this->getUrl('grid','admin',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','admin',null,true));
		}
	}

	public function deleteAction()
	{
			$getId = $this->getRequest()->getRequest('id'); 
		$adminTable = Ccc::getModel('Admin')->load($getId);
		try 
		{	
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $adminTable->delete(['adminId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$rd = $this->getUrl('grid','admin');
			echo $rd;
			
			$this->redirect($this->getUrl('grid','admin',null,true));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','admin',null,true));	
		}
	}
	
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>