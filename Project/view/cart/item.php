<?php $cartItems = $this->getCartItem(); //print_r($cartItems); die; ?>
<?php $products = $this->getProducts(); ?>
<?php $mediaModel = Ccc::getModel('Product_Media')?>
<?php $order = $this->getOrder();?>


    <h2>Item Info </h2>
<div id="addProduct" style = "display:none">
<form action="<?php echo $this->getUrl('addProduct','cart',null,false) ?>" method="POST">
        <button type="submit" name="Add" class="Registerbtn" > Add selected products </button>
        <button ><a href="<?php echo $this->getUrl('cartShow','cart',null,false) ?>">Cancel</a></button>
        <table border=1 width=100%>
            <tr>
                <th> Image </th>
                <th> Product Name </th>
                <th> Quantity </th>
                <th> Price </th>
                <th> Action </th>
                
            </tr>
                
            <?php if($products):?>
             <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php if(!$product->baseImage): echo "No Image"; ?>
                                <?php else:?>
                                <img src="<?php echo $mediaModel->getImageUrl() . $product->baseImage; ?>" width="100px" height="100px" alt="image">
                                <?php endif;?></td>
                        <td><?php echo $product->name ?></td>
                        <td><input type="number" name="quantity[<?php echo $product->productId ?>]"  min="1" max="<?php echo $product->quantity; ?>" value="1"></td>
                        <td><?php echo $product->price ?></td>
                         <td colspan="2"><input type="checkbox" name="selected[]" value="<?php echo $product->productId ?>"></td>
            <?php endforeach ?>

                        
            <?php else:?>
                <tr><td colspan='10'>No Record Available</td></tr>          
            <?php endif; ?>
        </table>
    </form>


</div>


<div id='info'>
    <form method="POST" action="<?php echo $this->getUrl('updateItem','cart',null,false) ?>">
        <button  type="button" name="Add" class="Registerbtn"  id="toggle"> Add New Products</button>
        <button type="submit" id="id1">Update</button>
        <table border=1 width=100%>
            <tr>
                <th> Image </th>
                <th> Product Name </th>
                <th> Quantity </th>
                <th> Price </th>
                <th> Total </th>
                <th> Action </th>
                
            </tr>
                
            <?php if($cartItems):?>
                <?php $total = 0 ?>
             <?php foreach ($cartItems as $cartItem): ?>
                    <tr>
                        <td><?php if(!$cartItem->baseImage): echo "No Image"; ?>
                                <?php else:?>
                                <img src="<?php echo $mediaModel->getImageUrl() . $cartItem->baseImage; ?>" width="100px" height="100px" alt="image">
                                <?php endif;?></td>
                        <td><?php echo $cartItem->name ?></td>
                        <td><input type="number" name="quantity[<?php echo $cartItem->itemId ?>]"  min="1" max="10" value="<?php echo $cartItem->quantity ?>"></td>
                        <td><?php echo $cartItem->price ?></td>
                        <td><?php echo $cartItem->price * $cartItem->quantity ?></td>
                        <td>
                            <a href="<?php echo$this->getUrl('removeProduct','cart',['itemId' => $cartItem->itemId],false) ?>">Delete</a> 
                        </td></tr>
                        <?php $total = $total + ($cartItem->price * $cartItem->quantity); ?>
            <?php endforeach ?>

                    <td> <?php if(!$cartItems):
                     $total = 0;
                        endif; ?></td><td></td><td></td><td></td>
       <td><input type="text" value="<?php echo $total; ?>" disabled></td>
                        
            <?php else:?>
                <tr><td colspan='10'>No Record Available</td></tr>          
            <?php endif; ?>
        </table>
    </form>
        
                    <script type="text/javascript">
                const targetDiv = document.getElementById("addProduct");
                const btn = document.getElementById("toggle");
                btn.onclick = function () {
                  if (targetDiv.style.display !== "none") 
                  {
                    targetDiv.style.display = "none";
                  } else {
                    targetDiv.style.display = "block";
                  }
                };
    </script>

   
    <br>
<hr>