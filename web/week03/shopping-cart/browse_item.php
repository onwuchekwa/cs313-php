<?php
    $pageTitle = 'Browse Items';
    include './common/header.php';
    require_once("ajax-action.php");      
?>

<main>
    <section>
        <h1 class="heading">Product Listing</h1>
        <a href="view_cart.php" title="View Cart" class="btn btn-primary"><img src="images/add-to-cart.png" alt="vew cart"> View Cart</a>
        <div class="product-container">
          <?php
            if(!empty($prodList)) {
              foreach($prodList as $row => $item) {
          ?>
          <div class="product-card">
            <form action="" id="formProduct">
              <div class="prod-image">
                <img src="<?php echo $prodList[$row]["productImage"]; ?>" alt="image of <?php echo $prodList[$row]["itemName"]; ?>">
              </div>
              <div>
                <div class="card-header prod-info">
                  <strong><?php echo $prodList[$row]["itemName"]; ?></strong>
                </div>
                <div class="card-body">
                  <div class="prod-price prod-info">                    
                    <?php echo "Price: $" . number_format($prodList[$row]["itemPrice"], 2); ?>
                  </div>
                </div>
                <div class="prod-info">
                  Quantity: <input type="number" id="quantity_<?php echo $prodList[$row]["itemCode"]; ?>" name="quantity" value="1" size="2" min="1" >
                </div>
                <div class="card-footer prod-info">
                  <button type="button" id="add_<?php echo $prodList[$row]["itemCode"]; ?>" class="btn btn-danger cart-action" onClick="manageCart('add','<?php echo $prodList[$row]["itemCode"]; ?>')"><img src="images/add-to-cart.png" alt="add to cart"> Add to cart</button>
                </div> 
              </div>
            </form>
          </div>
          <?php 
              }
            }
            ?>
        </div>
    </section>
</main>
<?php include './common/footer.php'; ?>