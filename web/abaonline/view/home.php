<?php 
    $pageTitle = 'Home';
    $pageDescription = 'Aba Online Direct seeks to help businesses to gain more exposure through advertising and marketing their trades to the users of the internet. We target small-, medium-, and large-scale businesses, who want to expose their merchandise, solutions, and trades to the user of the internet. We also target people who need solutions produced by these businesses.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 
?>

<main class="mb-3">
    <div class="hero-image">
        <img class="w-100" src= "/abaonline/images/aba2.jpg"> 
        <div class="hero-text">
            <!--<h1>Register with us</h1>
            <p>This is a text place holder</p>
            <button>Click me</button>-->
        </div>
    </div>

    <div class="company-listing text-center container">
        <?php
            if(isset($displayCompany)) {
                echo $displayCompany;
            }
        ?>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>