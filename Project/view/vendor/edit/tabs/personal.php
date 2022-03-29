<?php $vendor = $this->getVendor();?>

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
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>">
      <td>
          <button type="submit" class="cancelbtn">Next</button>
          <a href="<?php echo $this->getUrl('grid','vendor',null,false) ?>">
            <button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
