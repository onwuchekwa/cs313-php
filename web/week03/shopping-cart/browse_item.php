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
                        <button type="button" class="btn btn-primary" data-id="<?php echo $stockItem->itemId; ?>" data-toggle="modal" data-target=".product-modal">View Product Details</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade product-modal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include './common/footer.php'; ?>