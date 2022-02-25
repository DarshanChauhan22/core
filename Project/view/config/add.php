<?php $controllerCoreAction = new Controller_Core_Action();?>
<html>
<head>
</head>
<body>
  <form action="<?php echo $controllerCoreAction->getUrl('save','config',null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">Name</td>
      <td><input type="text" name="config[name]"></td>
    </tr>
    <tr>
      <td width="10%">Code</td>
      <td><input type="text" name="config[code]"></td>
    </tr>
    <tr>
      <td width="10%">Value</td>
      <td><input type="text" name="config[value]"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="config[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit">Save </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>