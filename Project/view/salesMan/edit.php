<?php $salesman = $this->getsalesman(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>




  <form action="<?php echo $controllerCoreAction->getUrl('save','salesman',null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="salesman[email]" value="<?php echo $salesman->email ?>"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="Password" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>"></td>
    </tr>
    <tr>
      <td width="10%">Percentage</td>
      <td><input type="number" step="0.01" name="salesman[percentage]" value="<?php echo $salesman->percentage ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="salesman[status]">
            <?php foreach ($salesman->getStatus() as $key => $value): ?>
              <option <?php if($salesman->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save</button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
