<?php
    $pageTitle = 'Browse Items';
    include getDocumentRoot('/web/week03/shopping/common/header.php');
?>

<main>
    <section>
        <h1>Product Listing</h1>
        <?php
            if(isset($productDisplay)){ 
                echo $productDisplay; 
            }
        ?>
    </section>
</main>

<?php include getDocumentRoot('/web/week03/shopping/common/footer.php'); ?>