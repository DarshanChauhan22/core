<?php
  $category = $this->getCategory();
  //$row = $this->getData('category');
  $categoryPathPair = $this->getData('categoryPathPair');
  $categoryPath = $this->getData('categoryPath');
  $controllerCoreAction = new Controller_Core_Action();
?>
<html>
<head>  
 
</head>
  <body>
    <form action="<?php echo $controllerCoreAction->getUrl('save','category',null,true) ?>" method="POST">
      <table border="1" width="100%" cellspacing="4">
        <tr>
          <td width="10%"> Name</td>
          <td><input type="text" name="category[name]" value="<?php echo $category['name'] ?>"></td>
        </tr>
        <input type="hidden" name="category[id]" value="<?php echo $category['categoryId'] ?>">
        <tr>
          <td width="10%">Status</td>
          <td>
            <select name="category[status]">
              <?php if ($category['status' ] == 1):?>
                  <option value='1'>Active</option>
                  <option value='2'>InActive</option>
              <?php else: ?>
                  <option value='2'>InActive</option>
                  <option value='1'>Active</option>
              <?php endif;?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="10%">Parent Category</td>
          <td>
            <select name="category[parentId]">
              
              <option value=<?php echo $category['parentId'] ?>><?php echo $categoryPath[$category['categoryId']]?></option>
              <option value="NULL">Root</option>
              <?php foreach ($categoryPathPair as $key=>$value): ?>
                  <?php if(strpos($value,$category['categoryPath']) !='false'):?>
                    <option value=<?php echo $key ?>><?php echo $categoryPath[$key] ?></option>
                  <?php endif; ?>
              <?php endforeach;?>

            </select>
          </td>
        </tr>
    
        <tr>
          <td width="25%">&nbsp;</td>
          <td>
            <button type="submit" name="submit" class="Registerbtn">Save </button>
            <a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
          </td>
        </tr>    
      </table>  
    </form>
    </body>
  </html>
