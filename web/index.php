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
  <title>Homepage | donsonde</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="assignment.php">My Assignments</a>
          </li>
        </ul>
      </div>
    </nav>     
  </header>

  <main>
    <div class="headerSection">
      <div class="row">
        <div class="col-sm-12">
          <div class="jumbotron jumbotron-fluid text-center">
            <div class="container">
              <h1 class="display-4">Welcome to my Assignment Portal</h1>
              <p class="lead"><em>CSE 341 Web Engineering II</em></p>
            </div>
          </div>
        </div>         
      </div>
    </div>

    <div class="my-info">             
      <h2>Who am I?</h2>
      <div class="row">
        <div class="col-sm-12 col-md-8"> 
          <div class="my-bio">
            <p class="content">            
              <img src="asset/images/sunday.jpg" class="float-left" alt="Sunday's picture">
              My name is Sunday Ogbonnaya Onwuchekwa, and I am majoring in Applied Technology at Brigham Young University, Idaho. I am a Nigerian, but has been working in Ghana as an IT Service Desk Analyst for the last 5 years. I served in the Nigeria Lagos Mission between 2002 and 2004 and have been married since 2005. My wife and I are parents of three children--two girls and a boy.
            </p>
            <p class="content">
              My wife and I currently serve as the Stake PathwayConnect Missionaries and Young Adult Advisers. These callings have help me to develop love for the young adult and a keen interest in their academic development. It has been difficult combining work, family, and church callings because I work forty hours per week. However, I have seen the hand of God directly me all the way even when I wanted to give up. I love seeing movies, playing games, singing, and eating.
            </p>
              <blockquote>
                <em class="d-block">
                  "That which we persist in doing becomes easier for us to do--not that the nature of the thing is changed, but that our power to do is increased."
                </em><strong>- Ralph Waldo Emerson</strong>
              </blockquote>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <figure>
            <img src="asset/images/missionaries.jpg" class="w-100" alt="missionaries">
            <figcaption>Left-right: Sister Onwuchekwa, Elders Onwuchekwa & Abunyaah</figcaption>
          </figure>
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