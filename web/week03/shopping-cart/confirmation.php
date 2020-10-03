<?php
    $pageTitle = 'View Cart';
    include './common/header.php';
    require_once("ajax-action.php");
    
    if(isset($_SESSION["cartItems"])){
        $itemTotal = 0;

        foreach($_SESSION["cartItems"] as $row => $item) {
            var_dump($_SESSION['clientData'][$row]['clientName']);
        }
?>

<main>
    <section>
        <h1 class="heading">Checkout</h1>
        <div id="cartItems chechout-container">
            <table class="customer info">
                <tbody>
                    <tr>
                        <td class="table-header">Client Name</td>
                        <td class="text-right"><?php echo $_SESSION['clientData']['clientName']; ?></td>
                    </tr>
                </tbody>                        
            </table>
            <table class="cartTable">
                <tbody>
                    <tr>
                        <th><strong>Product Name</strong></th>
                        <th><strong>Product Code</strong></th>
                        <th class="text-right"><strong>Quantity Ordered</strong></th>
                        <th class="text-right"><strong>Price</strong></th>
                    </tr>
                    <?php foreach($_SESSION['cartItems'] as $item):?>
                        <tr>
                            <td><strong><?php echo $item['itemName']; ?></strong></td>
                            <td><?php echo $item['itemCode']; ?></td>
                            <td class="text-right"><?php echo $item['quantity']; ?></td>
                            <td class="text-right"><?php echo "$". number_format($item['itemPrice'], 2); ?></td>                            
                        </tr>
                    <?php
                        $itemTotal += ($item['itemPrice'] * $item['quantity']);                
                        endforeach;
                    ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><?php echo "$". number_format($itemTotal, 2); ?></td>
                    </tr>
                </tbody>
            </table>
    <?php } else { ?>
            <p class="empty-cart text-center">Your cart is empty. Click <a href="browse_item.php" title="Return to browse item page">here</a> to add browse our products.</p>
    <?php } ?>
        </div>
    </section>
</main>

<?php include './common/footer.php'; ?>