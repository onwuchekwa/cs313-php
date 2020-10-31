<?php 
    $pageTitle = 'Registration';
    $pageDescription = 'To add a business, you must have an account with us.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/actions/index.php?action=login");
    }

    $contactInfo = getContactInfo($reference_id);
    $addressInfo = getAddressInfo($reference_id);

    $addressList = getAddressType();
    $contactList = getContactType();
    
    $bindAddressList = buildAddressTypeList($addressList);
    $bindContactList = buildContactTypeList($contactList);

    $category = getCategory();

    $reference_id = $_SESSION['businessOwnerData']['business_owner_id'];

    // Dynamically generate Sticky Category List
    $categoryList = "<select id='category_id' name='category_id' required>";
    $categoryList .= "<option selected disabled value=''>Select a Category</option>";
    foreach($categories as $category){
        $categoryList .= "<option id='$category[category_id]' value='$category[category_id]'";
        if(isset($categoryId)){
            if($category['category_id'] === $category_id){
                $categoryList .= ' selected ';
            }
        }
        $categoryList .= ">$category[category_name]</option>";
    }
    $categoryList .= "</select>";
?>

<main class="container main-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Business</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Register your business with Us
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Comapny Name" required <?php if(isset($company_name)){echo "value='$company_name'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_summary" class="col-sm-4 col-form-label">Company Summary</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_summary" name="company_summary" placeholder="Company Summary" required <?php if(isset($company_summary)){echo "value='$company_summary'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_full_info" class="col-sm-4 col-form-label">Company's Full Info</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="company_full_info" name="company_full_info" cols="30" rows="5" placeholder="Company's Full Background"><?php if(isset($company_full_info)){echo "value='$company_full_info'";} ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_address" class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email Address" required <?php if(isset($email_address)){echo "value='$email_address'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_address" class="col-sm-4 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <?php echo $categoryList; ?>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Register" class="btn btn-primary">
                                <input type="hidden" name="action" value="registered"> 
                            </div>
                        </div>     
                    </form>
                </div> 
                <div class="card-footer text-center">
                    <span class="d-block">Already a member?</span>
                    <a href="/abaonline/actions/index.php?action=login">Click here to login</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>