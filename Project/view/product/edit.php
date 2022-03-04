<?php $product = $this->getProduct(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
  
</head>
  <body>
   <form action='<?php echo $controllerCoreAction->getUrl('save','product',null,true) ?>' method='post'>
    <table border="1" width="100%" cellspacing="4">
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
          <td width="10%"> Quantity</td>
          <td><input type="number" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
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
            <button type="submit" name="submit" class="Registerbtn">Save</button>
            <a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
          </td>
        </tr>    
      </div>  
    </form>
  </body>
</html>