<?php
    $pageTitle = 'Checkout';
    include './common/header.php';
    require_once("ajax-action.php");
    
    if(isset($_SESSION["cartItems"])){
        $itemTotal = 0;
?>

<main>
    <section>
        <h1 class="heading">Checkout</h1>
        <div id="client-checkout">
            <div class="customer info">
                <form action="" method="POST">                    
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <label for="clientName" class="top"> Full Name: <span class="required">*</span>
                        <input type="text" name="clientName" id="clientName" placeholder="Enter your full name here" required>
                    </label>
                    <label for="clientEmail" class="top"> Email Address: <span class="required">*</span>
                        <input type="email" name="clientEmail" id="clientEmail" placeholder="Enter your email address here" required>
                    </label>
                    <label for="clientPhone" class="top"> Phone Number: <span class="required">*</span>
                        <input type="tel" name="clientPhone" id="clientPhone" placeholder="Enter your phone number here" required>
                    </label>
                    <label for="clientAddress" class="top"> Address: <span class="required">*</span>
                        <input type="text" name="clientAddress" id="clientAddress" placeholder="Enter your address here" required>
                    </label>
                    <label for="clientPostal" class="top"> Postal Code: <span class="required">*</span>
                        <input type="text" name="clientPostal" id="clientPostal" placeholder="Enter your postal code here" required>
                    </label>
                    <label for="clientState" class="top"> State: <span class="required">*</span>
                        <input type="text" name="clientState" id="clientState" placeholder="Enter your state here" required>
                    </label>
                    <a href="view_cart.php" title="Return to cart" class="btn btn-secondary">Return to cart</a>
                    <input type="button" value="Checkout" id="checkout" onClick="manageCart('checkout', '');" class="btn btn-primary">
                </form>
            </div>            
    <?php } else { ?>
            <p class="empty-cart text-center">Your cart is empty. Click <a href="browse_item.php" title="Return to browse item page">here</a> to add browse our products.</p>
    <?php } ?>
        </div>
    </section>
</main>

<?php include './common/footer.php'; ?>