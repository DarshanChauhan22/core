<?php $admin = $this->getAdmin(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>




  <form action="<?php echo $controllerCoreAction->getUrl('save','admin',null,false) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="email" name="admin[email]" value="<?php echo $admin->email ?>"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="Password" name="admin[password]" value="<?php echo $admin->password ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="admin[status]">
            <?php foreach ($admin->getStatus() as $key => $value): ?>
              <option <?php if($admin->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="admin[adminId]" value="<?php echo $admin->adminId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
