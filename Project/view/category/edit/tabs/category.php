<?php $category = $this->getCategories(); ?>
<?php $categoryPath = $this->getCategoryWithPath(); ?>
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
          <td width="10%"> Name</td>
          <td><input type="text" name="category[name]" value="<?php echo $category->name; ?>"></td>
        </tr>
        <input type="hidden" name="category[id]" value="<?php echo $category->categoryId; ?>">
        <tr>
          <td width="10%">Status</td>
          <td>
            <select name="category[status]" value="<?php echo $category->status;?>">
              <?php foreach ($category->getStatus() as $key => $value): ?>
              <option <?php if($category->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
      <td width="10%">Parent Category</td>
      <td>
        <select name="category[parentId]">
          <option value="NULL">Root</option>
            <?php foreach ($categoryPath as $key=>$value){?>
                <option value="<?php echo $key?>"
                <?php if ($category->parentId == $key) {
                echo "selected";
              } ?>><?php echo $value; ?>


                </option>
                <?php
             } 
            
          ?>
            
        </select>

      </td>
    </tr>
    <tr>
                <td width="25%">&nbsp;</td>
                <td>
                 <button type="button" class="btn btn-success" onclick="saveAndNext()">Next</button>
                 <button type="button" class="btn btn-danger" onclick="customerCancel()">Cancel</button>
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
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
    //alert(admin.getUrl());
    admin.load();
  }

  function customerCancel() 
  {
    admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]) ?>");
    alert(admin.getUrl());
    admin.load();
  }
</script>