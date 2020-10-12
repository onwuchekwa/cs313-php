<?php 
    $pageTitle = 'Registration';
    $pageDescription = 'To add a business, you must have an account with us.';
    include './common/header.php'; 
?>

<main>
    <div class="col-md-3"></div>
    <div class="col-sm-12 col-md-6">
        <div class="card text-center">
            <div class="card-header">
                Register with Us
            </div>
            <div class="card-body">
            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form action="../actions/index.php" method="POST">
                <fieldset>
                    <legend>All fields marked asterisk (*) are required</legend>
                    <div class="form-group">
                        <label for="firstName">First name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="middleName">Middle name</label>
                        <input type="text" class="form-control" id="middleName" placeholder="Enter middle name">
                    </div>
                </fieldset>
            </div>
            <div class="card-footer text-muted">
                <input type="submit" value="Register" class="btn btn-primary">
                <input type="hidden" name="action" value="register">
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</main>

<?php include './common/footer.php'; ?>