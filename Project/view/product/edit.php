<?php $product = $this->getProduct(); ?>
<?php $categoryPath = $this->getCategoryWithPath();?>
<?php $categories = $this->getCategories(); ?>
<?php $categoryProductPair = $this->getCategoryProductPair();?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

   <form action='<?php echo $controllerCoreAction->getUrl('save','product',null,false) ?>' method='post'>
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
          <td width="10%"> Sku</td>
          <td><input type="text" name="product[sku]" value="<?php echo $product->sku ?>"></td>
        </tr>

        <tr>
        <td width="10%">Categories</td>
        <td>
          <table border='1'>
            <tr>
              <th>Check Box</th>
              <th>Category Id</th>
              <th>Category Name</th>
            </tr>
              
        <?php foreach ($categories as $categoryProduct): ?>
        <tr>
          <td><input type="checkbox" name="product[category][]" value="<?php echo $categoryProduct->categoryId ?>"<?php if($categoryProductPair):
            if(in_array($categoryProduct->categoryId, $categoryProductPair)): ?>
              checked
            <?php endif; ?>
            <?php endif; ?>></td>
            <td><?php echo $categoryProduct->categoryId ?></td>
            <td>
            <?php $result = $categoryPath; 
                echo $result[$categoryProduct->categoryId];
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
          </table>
        </td>
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
            <a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,false) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
          </td>
        </tr>    
      </div>  
  </table>
    </form>
 