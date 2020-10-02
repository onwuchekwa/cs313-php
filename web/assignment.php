<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--CSS begins-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="asset/css/styles.css">
   <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <title>Assignment | donsonde</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.html">DONSONDE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="assignment.php">My Assignments <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>     
  </header>

  <main>
    <div class="hero-container">
        <img src="asset/images/university.jpg" class="w-100 changeHeight" alt="learning">
    </div>

    <div class="my-info"> 
      <div class="row">
        <div class="col-sm-12"> 
            <p class="content text-center">                    
              <span class="contentText">Link to Assignments</span>
            </p> 
             <ul class="text-center">
               <li><a class="assignment-link" href="./week03/shopping-cart/browse_item.php" title="Shopping Cart">Shopping Cart</a></li>
             </ul>     
          </div>
        </div>
    </div>
  </main>

  <footer class="footer bg-dark">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-lg-3 trademark">
          <p class="copy">&copy;<?php echo date('Y'); ?> donsonde, All rights Reserved.</p>
        </div>
        <div class="col-sm-12 col-lg-5">
          
        </div>
        <div class="col-sm-12 col-lg-4 socialWrapper">
          <a href="https://facebook.com" target="_blank">
            <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
          </a>
          <a href="https://instagram.com" target="_blank">
            <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
          </a>
          <a href="https://twitter.com" target="_blank">
            <i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>