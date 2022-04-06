
<?php $productsWithPercentage = $this->getProducts(); ?>
<?php $products = $productsWithPercentage['products']; ?>
<?php $percentage = $productsWithPercentage['percentage']; ?>
<?php $prices = $this->getPrices(); ?>


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
		<th>Product ID</th>
		<th>Name</th>
		<th>Sku</th>
		<th>Price</th>
		<th>Salesman Price</th>
		<th>Customer Price</th>
	</tr>
	<form action="<?php echo $this->getUrl('save','customer_price'); ?>" method="POST">
		<?php 
			
			if(!$products):
				echo '<tr><td colspan="6">No Records available</td></tr>';
			else:
				foreach($products as $product):
				 	?>
					<tr>
						<td><?php echo $product->productId; ?></td>
			 			<td><?php echo $product->name; ?></td>
			 			<td><?php echo $product->sku; ?></td>
			 			<td><?php echo $product->price; ?></td>
			 			<td><?php echo $discountPrice = $product->price - ($product->price * $percentage) / 100; ?></td>
			 			<td>
			 				<input type="number" name="<?php if($prices): if(array_key_exists($product->productId, $prices)):?> price[exists][<?php echo $product->productId; ?>] <?php else: ?> price[new][<?php echo $product->productId; ?>] <?php endif; endif;?> price[new][<?php echo $product->productId; ?>] ?>" step="0.01" min="<?php echo $discountPrice; ?>" max="<?php echo $product->price; ?>" value="<?php echo $prices[$product->productId]; ?>" required>
			 			</td>
			 		</tr>
				<?php endforeach;
			endif;
		?>
		<tr>
			<td colspan="6">
				<input type="submit" name="save" value="Save">
				<button class="btn btn-primary"><a href="<?php echo $this->getUrl('grid','salesman_customer',null,false) ?>">Cancel</a></button>
			</td>
		</tr>
	</form>

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
    //alert(admin.getUrl());
    admin.load();
  }

  function vendorCancel() 
  {
    admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
    admin.load();
  }
</script>












































