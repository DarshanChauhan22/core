<?php $vendor = $this->getVendor(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

  <form action="<?php echo $controllerCoreAction->getUrl('save',null,null,false) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b></td>
    </tr>
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="vendor[email]" value="<?php echo $vendor->email ?>"></td>
    </tr>
    <tr>
      <td width="10%">Mobile</td>
      <td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="vendor[status]">
            <?php foreach ($vendor->getStatus() as $key => $value): ?>
              <option <?php if($vendor->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2"><b>Address Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="address[address]" value="<?php echo $vendor->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="address[city]" value="<?php echo $vendor->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="address[state]" value="<?php echo $vendor->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="address[postalCode]" value="<?php echo $vendor->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="address[country]" value="<?php echo $vendor->country ?>"></td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>">
      <input type="hidden" name="address[vendorAddressId]" value="<?php echo $vendor->vendorAddressId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save</button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
