<?php 
    $pageTitle = 'Change Password';
    $pageDescription = 'This page allows a user to change password';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 
?>

<main class="container main-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item"><a href="/abaonline/actions/" title="return to dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change my Password</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Sign in
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/" method="POST">
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <span class="text-danger password-size">Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="User name" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <span class="text-danger password-size">Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Change Password" class="btn btn-primary">
                                <input type="hidden" name="action" value="modify-password"> 
                                <input type="hidden" name="userName" value="<?php echo $userName; ?>"> 
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>