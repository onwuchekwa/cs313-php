<?php 
    $pageTitle = 'Delete Company';
    $pageDescription = 'To delete a business, you must have an account with us and logged into it.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/");
    }

    $userName = $_SESSION['businessOwnerData']['user_name'];
?>

<main class="container main-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item"><a href="/abaonline/actions/" title="return to dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delete my Company</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Delete <?php $companyInfo['company_name']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <p class='bg-danger p-3 text-white'>This action will delete the company's information. Are you sure you want to proceed with this action because it cannot be undone?</p>
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Comapny Name" <?php if(isset($company_name)){echo "value='$company_name'";} elseif(isset($companyInfo['company_name'])) { echo "value='$companyInfo[company_name]'"; } ?> readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_summary" class="col-sm-4 col-form-label">Company Summary</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_summary" name="company_summary" placeholder="Company Summary" <?php if(isset($company_summary)){echo "value='$company_summary'";} elseif(isset($companyInfo['company_summary'])) { echo "value='$companyInfo[company_summary]'"; } ?> readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Delete Company" class="btn btn-primary">
                                <input type="hidden" name="action" value="delete-company_info"> 
                                <input type="hidden" name="company_id" value="<?php if(isset($company_id)){echo "value='$company_id'";} elseif(isset($companyInfo['company_id'])) { echo "value='$companyInfo[company_id]'"; } ?>"> 
                                <input type="hidden" name="del_contact_detail_id" value="<?php if(isset($contact_detail_id)){echo "value='$contact_detail_id'";} elseif(isset($companyInfo['contact_detail_id'])) { echo "value='$companyInfo[contact_detail_id]'"; } ?>"> 
                                <input type="hidden" name="del_address_detail_id" value="<?php if(isset($address_detail_id)){echo "value='$address_detail_id'";} elseif(isset($companyInfo['address_detail_id'])) { echo "value='$companyInfo[address_detail_id]'"; } ?>"> 
                                <input type="hidden" name="userName" value="<?php if(isset($businessOwnerData['user_name'])){ echo $businessOwnerData['user_name'];} elseif(isset($userName)){ echo $userName; } ?>">
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>