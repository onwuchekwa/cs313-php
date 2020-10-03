<?php
    $pageTitle = 'Confirmation';
    include './common/header.php';
    //require_once("ajax-action.php");
    session_start();

    if(isset($_SESSION["cartItems"])){
        $itemTotal = 0;

        $clientName = filter_input(INPUT_POST, 'clientName', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPhone = filter_input(INPUT_POST, 'clientPhone', FILTER_SANITIZE_STRING);
        $clientAddress = filter_input(INPUT_POST, 'clientAddress', FILTER_SANITIZE_STRING);
        $clientPostal = filter_input(INPUT_POST, 'clientPostal', FILTER_SANITIZE_STRING);
        $clientState = filter_input(INPUT_POST, 'clientState', FILTER_SANITIZE_STRING);

        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        $clientEmail = $valEmail;
?>

<main>
    <div>
        <div class="heading">Confirm Purchase</div>
        <div id="cartItems" class="checkout-container">
            <table class="customerInfo">
                <tbody>
                    <tr>
                        <td class="text-left"><strong>Client Name:</strong></td>
                        <td class="text-left"><?php echo $clientName; ?></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Client Email:</strong></td>
                        <td class="text-left"><?php echo $clientEmail; ?></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Client Phone:</strong></td>
                        <td class="text-left"><?php echo $clientPhone; ?></td>
                    </tr>
                    <tr>
                        <td class="table-header"><strong>Client Address:</strong></td>
                        <td class="text-left"><?php echo $clientAddress . ', '. $clientPostal . ', ' . $clientState; ?></td>
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
                    <tr>
                        <td colspan="5" class="text-right"><a href="thanks.php" title="Procced to thank you page"  class="btn btn-success">Confirm Purchase</a></td>
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