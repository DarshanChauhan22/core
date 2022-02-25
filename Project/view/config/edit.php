<?php $config = $this->getConfig();  ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>



<html>
<head>
</head>
<body>
  <form action="<?php echo $controllerCoreAction->getUrl('save','config',null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">Name</td>
      <td><input type="text" name="config[name]" value="<?php echo $config->name; ?>"></td>
    </tr>
    <tr>
      <td width="10%">Code</td>
      <td><input type="text" name="config[code]" value="<?php echo $config->code; ?>"></td>
    </tr>
    <tr>
      <td width="10%">Value</td>
      <td><input type="text" name="config[value]" value="<?php echo $config->value; ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="config[status]">

          <?php if ($config->status == 1):?>
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
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="config[configId]" value="<?php echo $config->configId; ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Update </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>