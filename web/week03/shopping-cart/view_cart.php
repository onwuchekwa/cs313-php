<?php
    $pageTitle = 'View Cart';
    include './common/header.php';
    require_once("ajax-action.php");
    
    if(isset($_SESSION["cartItems"])){
        $itemTotal = 0;
?>

<main>
    <div>
        <div class="heading">View Cart <a class="btn btn-primary btnEmpty cart-action" onClick="manageCart('empty','');"><img src="images/icon-empty.png" alt="delete item"> Empty Cart</a></div>
        <div id="cartItems">
            <table class="cart-table table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th><strong>Product Name</strong></th>
                        <th><strong>Product Code</strong></th>
                        <th class="text-right"><strong>Quantity Ordered</strong></th>
                        <th class="text-right"><strong>Unit Price</strong></th>
                        <th class="text-right"><strong>Amount</strong></th>
                        <th></th>
                    </tr>
                    <?php foreach($_SESSION['cartItems'] as $item):?>
                        <tr>
                            <td><strong><?php echo $item['itemName']; ?></strong></td>
                            <td><?php echo $item['itemCode']; ?></td>
                            <td class="text-right"><?php echo $item['quantity']; ?></td>
                            <td class="text-right"><?php echo "$". number_format($item['itemPrice'], 2); ?></td>
                            <td class="text-right"><?php echo "$". number_format($item['itemPrice'] * $item['quantity'], 2); ?></td>
                            <td class="text-center"><a onClick="manageCart('remove','<?php echo $item["itemCode"]; ?>')" class="btn btn-danger cart-action"><img src="images/icon-delete.png" alt="delete item"></a></td>
                        </tr>
                    <?php
                        $itemTotal += ($item['itemPrice'] * $item['quantity']);                
                        endforeach;
                    ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><?php echo "$". number_format($itemTotal, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right"><a href="browse_item.php" title="View Cart" class="btn btn-dark">Add more item</a></td>
                        <td class="text-left"><a href="checkout.php" title="Proceed to checkout" class="btn btn-success">Proceed to checkout</a></td>
                    </tr>
                </tbody>
            </table>
    <?php } else { ?>
            <p class="empty-cart text-center">Your cart is empty. Click <a href="browse_item.php" title="Return to browse item page">here</a> to add browse our products.</p>
    <?php } ?>
        </div>
    </div>
</main>

<?php include './common/footer.php'; ?>