<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Page'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Page extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$this->setTitle("Page Grid");
		$content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();
	}

	public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $pageGrid = Ccc::getBlock('page_Index');
        $content->addChild($pageGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $pageGrid = Ccc::getBlock("page_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         //$messageBlock->addMessage('hiiiiiiii');
         $response = [
            'status' => 'success',
            'content' => $pageGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);

    }

    public function addBlockAction()
    {
        $page = Ccc::getModel('page');
        Ccc::register('page',$page);
        $pageAdd = $this->getLayout()->getBlock('page_Edit')->toHtml();

        $response = [
            'status' => 'success',
            'content' => $pageAdd
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
            $pageModel = Ccc::getModel('page')->load($id);
            $page = $pageModel->fetchRow("SELECT * FROM `page` WHERE `pageId` = $id");

            
            if(!$page)
            {
                throw new Exception("unable to load page.");
            }
            $content = $this->getLayout()->getContent();
             Ccc::register('page',$page);
           
            $pageEdit = Ccc::getBlock("page_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $pageEdit
         ] ;
        $this->renderJson($response);
    }

	public function addAction()
	{
		$this->setTitle("Page Add");
		$page = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
		Ccc::register('page',$page);
        $pageAdd = Ccc::getBlock("Page_Edit");//->setData(['page'=> $page]);
        $content->addChild($pageAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$this->setTitle("Page Edit");
			$message = $this->getMessage();
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$page = Ccc::getModel('Page')->load($id);
			if(!$page)
			{
				throw new Exception("unable to load page.");
			}
			Ccc::register('page',$page);
			$content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock("Page_Edit");//->setData(['page'=> $page]);
            $content->addChild($pageEdit);
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
            $row = $this->getRequest()->getPost('page');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 
            $pageId = (int)$this->getRequest()->getRequest('id');
            $page = Ccc::getModel('Page')->load($pageId);

            if(!$page)
            {
            	$page = Ccc::getModel('Page');
            	$page->setData($row);
               	$page->createdAt = $date;
            }
            else
            {
            	$page->setData($row);
            	$page->updatedAt = $date;
            }
            $result = $page->save();

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect('gridBlock','page',['id' => null],false);
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect('gridBlock','page',null,true);
        }

}
	
	
	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$pageTable = Ccc::getModel('Page')->load($getId);
			if (!$getId) 
			{
				throw new Exception("Invalid Request.");
			}
			$delete = $pageTable->delete(['pageId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");
										
			}
			$message->addMessage('Delete Successfully.');	
			$this->redirect('gridBlock',null,['id' => null],false);	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect('gridBlock',null,['id' => null],false);		
		}
	}
}
