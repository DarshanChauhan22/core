<?php $product = $this->getProducts(); ?>


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
                  <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
                  <td width="10%"> Name</td>
                  <td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
                </tr>
                <tr>
                  <td width="10%"> Price</td>
                  <td><input type="float" name="product[price]" value="<?php echo $product->price ?>"></td>
                </tr>
                <tr>
                  <td width="10%"> Tax</td>
                  <td><input type="number" name="product[tax]" value="<?php echo $product->tax ?>"></td>
                </tr>
                <tr>
                  <td width="10%"> Quantity</td>
                  <td><input type="number" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
                </tr>
                <tr>
                  <td width="10%"> Cost</td>
                  <td><input type="number" name="product[cost]" value="<?php echo $product->cost ?>"></td>
                </tr>
                <tr>
                  <td width="10%"> Discount</td>
                  <td><input type="number" name="product[discount]" value="<?php echo $product->discount ?>"></td>
                </tr>
                <tr>
                  <td width="10%">Discount Mode</td>
                  <td>
                    <select name="product[discountMode]">
                     <?php foreach ($product->getdiscountMode() as $key => $value): ?>
                      <option <?php if($product->discountMode == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="10%"> Sku</td>
                <td><input type="text" name="product[sku]" value="<?php echo $product->sku ?>"></td>
              </tr>
              <tr>


              </tr>

              <tr>
                <td width="10%">Status</td>
                <td>
                  <select name="product[status]">
                   <?php foreach ($product->getStatus() as $key => $value): ?>
                    <option <?php if($product->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>
            <tr>
              <td width="25%">&nbsp;</td>
              <td>
               <button type="button" class="btn btn-success" onclick="saveAndNext()">Next</button>
               <button type="button"class="btn btn-danger" onclick="customerCancel()">Cancel</button>
             </td>
           </tr>    
         </div>
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
    admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
    admin.load();
  }
</script>