<?php $carts = $this->getCarts(); ?>


<form action="<?php echo $this->getUrl('add','cart',null,false) ?>" method="POST">
        <button type="submit" name="Add" class="Registerbtn">Add To Cart</button>
    </form>

<div id='info'>
        <table border=1 width=100%>
            <tr>
                <th> Id </th>
                <th> Customer ID </th>
                <th> Total </th>
                <th> Shipping Method </th>
                <th> Payment Method </th>
                <th> Shipping Amount </th>
                <th> Created Date </th>
               
            </tr>
            <?php if($carts):
                foreach ($carts as $cart): ?>
                    <tr>
                        <td><?php echo $cart->cartId ?></td>
                        <td><?php echo $cart->customerId ?></td>
                        <td><?php echo $cart->total ?></td>
                        <td><?php echo $cart->shippingMethodId ?></td>
                        <td><?php echo $cart->paymentMethodId ?></td>
                        <td><?php echo $cart->shippingAmount ?></td>
                        <td><?php echo $cart->createdAt ?></td>
                        
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr><td colspan='10'>No Record Available</td></tr>          
            <?php endif; ?>
        </table>
    
