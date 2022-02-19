<?php 
  //$result = $this->getData('getCategoryToPath');
$categoriepath = $this->getCategoriePath();

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
      <td><input type="text" name="category[name]"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="category[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td width="10%">Parent Category</td>
      <td>
        <select name="category[parentId]">
          <option value="NULL">Root</option>
            <?php foreach ($categoriepath as $key=>$value):?>
                <option value=<?php echo $key?>><?php echo $value; ?></option>
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
  </html