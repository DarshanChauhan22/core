<?php $config = $this->getConfig();?>


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
          <?php foreach ($config->getStatus() as $key => $value): ?>
              <option <?php if($config->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="config[configId]" value="<?php echo $config->configId; ?>">
      <td>
        <button class="btn btn-success" type="button" onclick="configSave()">Save</button>
      <button class="btn btn-danger" type="button" onclick="configCancel()">Cancel</button>
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

  function configSave() 
  {
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
  }

  function configCancel() 
  {
        admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
        admin.load();
  }
</script>



















  