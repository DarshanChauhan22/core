<?php $salesMan = $this->getSalesMan(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>



<html>
<head>
</head>
<body>
  <form action="<?php echo $controllerCoreAction->getUrl('save','salesMan',null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="salesMan[firstName]" value="<?php echo $salesMan->firstName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="salesMan[lastName]" value="<?php echo $salesMan->lastName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="salesMan[email]" value="<?php echo $salesMan->email ?>"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="Password" name="salesMan[mobile]" value="<?php echo $salesMan->mobile ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="salesMan[status]">

          <?php if($salesMan->status == 2): ?>
              <option value='2'>InActive</option>
              <option value='1'>Active</option>
          <?php else: ?>
              <option value='1'>Active</option>
              <option value='2'>InActive</option>
          <?php endif;?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="salesMan[salesManId]" value="<?php echo $salesMan->salesManId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Update </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','salesMan',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>