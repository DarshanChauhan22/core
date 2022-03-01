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
		//$this->randerLayout();
		//Ccc::getBlock('SalesMan_grid')->toHtml();	
	}

	public function addAction()
	{
		$salesMan = Ccc::getModel('SalesMan');
		$content = $this->getLayout()->getContent();
        $salesManAdd = Ccc::getBlock("SalesMan_Edit")->addData("salesMan", $salesMan);
        $content->addChild($salesManAdd);
        $this->renderLayout();	
		//Ccc::getBlock('SalesMan_Edit')->addData('salesMan',$salesMan)->toHtml();	
		//Ccc::getBlock('SalesMan_Add')->toHtml();
	}

	public function editAction()
	{	
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$salesMan = Ccc::getModel('SalesMan')->load($id);
			//$salesMan = $salesManModel->fetchRow("SELECT * FROM salesMan WHERE salesManId = {$id} ");
			if(!$salesMan){
				throw new Exception("unable to load salesMan.");
			}
			//Ccc::getBlock('SalesMan_Edit')->addData('salesMan',$salesMan)->toHtml();	
				
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
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		//$salesManTable = Ccc::getModel('SalesMan_Resource');
		try
		{
			//$id = (int) $this->getRequest()->getRequest('admimId');
			$salesMan = Ccc::getModel('SalesMan');

       		//$salesMan = $salesManModel->getRow();
			$row = $this->getRequest()->getRequest('salesMan');
			/*print_r($row);
			exit();*/
			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
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
                $salesMan->save();
                /*var_dump($salesMan);
                exit();*/
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
                $salesMan->save();
       			}


			/*if (array_key_exists('salesManId', $row)) {
				if(!(int)$row['salesManId']){
					throw new Exception("Invalid Request.", 1);
				}
				$salesManId = $row["salesManId"];

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "mobile" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];
				
				$update=$salesManTable->update($query,['salesManId' => $salesManId]);

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "mobile" => $row['mobile'],
                    "mobile=" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

				$update = $salesManTable->update($query , ['salesManId' => $salesManId]);

				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				
				$salesManId = $salesManTable->insert($row);
				if(!$salesManId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}*/
			$this->redirect($this->getUrl('grid','salesMan',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','salesMan',null,true));
		}
	}

	public function deleteAction()
	{
			$getId = $this->getRequest()->getRequest('id'); 
		$salesManTable = Ccc::getModel('SalesMan')->load($getId);
		try 
		{	
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $salesManTable->delete(['salesManId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$rd = $this->getUrl('grid','salesMan');
			echo $rd;
			
			$this->redirect($this->getUrl('grid','salesMan',null,true));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','salesMan',null,true));	
		}
	}
	
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>