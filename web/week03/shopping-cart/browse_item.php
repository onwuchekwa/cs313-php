<?php
    $pageTitle = 'Browse Items';
    include './common/header.php';

    $file = './data/stock.json';
    $openFIle = fopen($file, 'r') or die("Error: Unable to open file. Check if the file exist.");
    $readFile = fread($openFIle, filesize($file));
    $stockItems = json_decode($readFile);

    session_start();

    $_SESSION['stockItems'] = $stockItems;
    
?>

<main>
    <section>
        <h1>Product Listing</h1>
        <div class="product-container">
            <?php foreach($stockItems as $stockItem): ?>
                <div class="product-card">
                    <h2 class="card-header"><?php echo $stockItem->itemName; ?></h2>
                    <div class="card-body">
                        <img class="img-fluid d-width" src="./images/<?php echo $stockItem->tnImage; ?>" alt="An image of <?php echo $stockItem->itemName; ?>">
                        <h3>Price: $<?php echo number_format($stockItem->itemPrice, 2); ?></h3>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-primary openModal" data-itemid="<?php echo $stockItem->itemId; ?>">View Product Details</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="contentLabel">Contact Us</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <img class="img-fluid w-100" src="images/bb_phlexi_modal.png" alt="BB Modal Image">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="modalFormWrapper">
                      <form>
                        <div class="form-group">
                          <label for="forName">What's your full name?</label>
                          <input type="text" class="form-control" id="forName" placeholder="Name">
                        </div>
                        <div class="form-group">
                          <label for="forEmail">What's your email address?</label>
                          <input type="text" class="form-control" id="forEmail" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="forComment">How can we help you?</label>
                          <textarea class="form-control" id="forComment" placeholder="Comment" cols="30" rows="5"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-bg" id="sendMessage">Send</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>            
            </form>
          </div>
        </div>
      </div>
</main>

<script>
  $(document).ready(function() {
    $(".openModal").click(function() {
      let itemId = $(this).data("itemid");
      alert(itemId);
      $("#productModal").modal("show");
    });
  });
</script>

<?php include './common/footer.php'; ?>