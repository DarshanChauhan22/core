<?php $page = $this->getPage(); ?>

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
      <td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
    </tr>
    <tr>
      <td width="10%">Code</td>
      <td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="text" name="page[content]" value="<?php echo $page->content ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="page[status]">
            <?php foreach ($page->getStatus() as $key => $value): ?>
              <option <?php if($page->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>">
      <td>
        <button type="button" class="btn btn-success" onclick="pageSave()">Save</button>
      <button type="button" class="btn btn-danger" onclick="pageCancel()">Cancel</button>
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

  function pageSave() 
  {
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
  }

  function pageCancel() 
  {
        admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
        admin.load();
  }
</script>






























  