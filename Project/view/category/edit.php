<?php $category = $this->getCategory(); ?>
<?php $categoryPath = $this->getCategoriePath(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

    <form action="<?php echo $controllerCoreAction->getUrl('save','category',null,true) ?>" method="POST">
      <table border="1" width="100%" cellspacing="4">
        <tr>
          <td width="10%"> Name</td>
          <td><input type="text" name="category[name]" value="<?php echo $category->name; ?>"></td>
        </tr>
        <input type="hidden" name="category[id]" value="<?php echo $category->categoryId; ?>">
        <tr>
          <td width="10%">Status</td>
          <td>
            <select name="category[status]" value="<?php echo $category->status;?>">
              <?php foreach ($category->getStatus() as $key => $value): ?>
              <option <?php if($category->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
      <td width="10%">Parent Category</td>
      <td>
        <select name="category[parentId]">
          <option value="NULL">Root</option>
            <?php foreach ($categoryPath as $key=>$value){?>
                <option value="<?php echo $key?>"
                <?php if ($category->parentId == $key) {
                echo "selected";
              } ?>><?php echo $value; ?>


                </option>
                <?php
             } 
            
          ?>
            
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
    
