<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/abaonline/index.php" title="Homepage">
    <img src="/abaonline/images/logo.png" class="d-inline-block img-logo" alt="company logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#abaOnlineDirectNavigation" aria-controls="abaOnlineDirectNavigation" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="abaOnlineDirectNavigation">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/abaonline/index.php" title="Homepage">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" title="Categories">CATEGORIES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" title="All Listings">ALL LISTINGS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" title="About Us">ABOUT US</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" title="Contact Us">CONTACT US</a>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <?php if(isset($login_session) == TRUE) {
            echo '<a class="nav-link mr-2" href="/abaonline/actions/" title="View my profile"><i class="fa fa-user fa-lg"></i> <span class="text-uppercase">Welcome '. $first_name .'</span></a>';
          }
        ?>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="/abaonline/actions/index.php?action=add-business" title="Add Business"><i class="fa fa-plus fa-lg"></i> ADD BUSINESS</a>
      </li>
      <li class="nav-item">
        <?php if(isset($login_session) == TRUE) {
          echo '<a href="/abaonline/actions/index.php?action=logout" title="Logout and return to the home page." class="nav-link btn btn-danger ml-2"><i class="fa fa-sign-out fa-lg"></i> Logout</a>';
        } else {          
          echo '<a class="nav-link btn btn-warning mr-2" href="/abaonline/actions/index.php?action=registration" title="Sign Up"><i class="fa fa-user-plus fa-lg"></i> SIGN UP</a></li><li class="nav-item"><a class="nav-link btn btn-outline-success" href="/abaonline/actions/index.php?action=login" title="Sign In"><i class="fa fa-sign-in fa-lg"></i> SIGN IN</a>';          
        }
        ?>
      </li>
    </ul>
  </div>
</nav>