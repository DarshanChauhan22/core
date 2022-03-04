<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Page');
Ccc::loadClass('Model_Core_Request');

class Controller_Page extends Controller_Core_Action{
	
	public function testAction()
	{
		$pageTable = new Model_Page(); 
		$pageTable->setTableName('page');
		$pageTable->setPrimaryKey('pageId');
	}
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();
		//$this->randerLayout();
		//Ccc::getBlock('Page_grid')->toHtml();	
	}

	public function addAction()
	{
		$page = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock("Page_Edit")->addData("page", $page);
        $content->addChild($pageAdd);
        $this->renderLayout();	
		//Ccc::getBlock('Page_Edit')->addData('page',$page)->toHtml();	
		//Ccc::getBlock('Page_Add')->toHtml();
	}

	public function editAction()
	{	
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$page = Ccc::getModel('Page')->load($id);
			//$page = $pageModel->fetchRow("SELECT * FROM page WHERE pageId = {$id} ");
			if(!$page){
				throw new Exception("unable to load page.");
			}
			//Ccc::getBlock('Page_Edit')->addData('page',$page)->toHtml();	
			$content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock("Page_Edit")->addData("page", $page);
            $content->addChild($pageEdit);
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
		//$pageTable = Ccc::getModel('Page_Resource');
		try
		{
			//$id = (int) $this->getRequest()->getRequest('admimId');
			$page = Ccc::getModel('Page');

       		//$page = $pageModel->getRow();
			$row = $this->getRequest()->getRequest('page');

			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('pageId',$row) && $row['pageId'] == null)
       		 {
                $page->name = $row['name'];
                $page->code =  $row['code'];
                $page->content =  $row['content'];
                $page->status =  $row['status'];
                $page->createdAt =  $date;
                $page->updatedAt =  null;
                $page->save();
        	}
        	else
        	{

                $page->load($row['pageId']);
                $page->pageId = $row["pageId"];
                 $page->name = $row['name'];
                $page->code =  $row['code'];
                $page->content =  $row['content'];
                $page->status =  $row['status'];
                //$page->createdAt = $row['createdAt'];
                $page->updatedAt =  $date;
                $page->save();
       			}


			/*if (array_key_exists('pageId', $row)) {
				if(!(int)$row['pageId']){
					throw new Exception("Invalid Request.", 1);
				}
				$pageId = $row["pageId"];

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "password" => $row['password'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];
				
				$update=$pageTable->update($query,['pageId' => $pageId]);

				$query = [
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "email" => $row['email'],
                    "password" => $row['password'],
                    "mobile=" => $row['mobile'],
                    "status" =>$row['status'],
                    "updatedAt" => $date];

				$update = $pageTable->update($query , ['pageId' => $pageId]);

				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				
				$pageId = $pageTable->insert($row);
				if(!$pageId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}*/
			$this->redirect($this->getUrl('grid','page',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','page',null,true));
		}
	}

	public function deleteAction()
	{
			$getId = $this->getRequest()->getRequest('id'); 
		$pageTable = Ccc::getModel('Page')->load($getId);
		try 
		{	
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $pageTable->delete(['pageId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$rd = $this->getUrl('grid','page');
			echo $rd;
			
			$this->redirect($this->getUrl('grid','page',null,true));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','page',null,true));	
		}
	}
	
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>