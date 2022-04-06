<?php $salesman = $this->getsalesman(); ?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
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
      <td width="10%">Mobile</td>
      <td><input type="text" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>"></td>
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
            <button type="button" class="btn btn-success" onclick="saveAndNext()">Next</button>
            <button  type="button" class="btn btn-danger" onclick="vendorCancel()">Cancel</button>
      </td>
    </tr>   
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>


</div>







<script type="text/javascript">

  function saveAndNext() 
  {
    admin.setForm(jQuery('#indexForm'));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    alert(admin.getUrl());
    admin.load();
  }

  function vendorCancel() 
  {
    admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
    admin.load();
  }
</script>