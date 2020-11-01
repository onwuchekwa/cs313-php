<?php

// Check if Email Address is valid
function checkEmail($emailAddress){
    $valEmail = filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

// Build the contact type select list 
function buildContactTypeList($contactTypes) {
    $contactTypeList = '<select id="contactTypeId" name="contactTypeId" class="form-control" required>'; 
    $contactTypeList .= "<option value='' selected disabled>Choose Contact Type</option>"; 
    foreach($contactTypes as $contactType) { 
        $contactTypeList .= "<option id='$contactType[contact_type_id]' value='$contactType[contact_type_id]'"; 
        if(isset($contactTypeId)){            
            if($contactType['contact_type_id'] === $contactTypeId){
                $contactTypeList .= ' selected ';
            }
        } elseif(isset($contactInfo['contact_type_id'])) {
            if($contactType['contact_type_id'] === $contactInfo['contact_type_id']) {
                $addressTypesList .= ' selected ';
            }
        }
        $contactTypeList .= ">$contactType[description]</option>";
    } 
    $contactTypeList .= '</select>'; 
    return $contactTypeList; 
}

// Build the address type select list 
function buildAddressTypeList($addressTypes) {
    $addressTypesList = '<select id="addressTypeId" name="addressTypeId" class="form-control" required>'; 
    $addressTypesList .= "<option value='' selected disabled>Choose Address Type</option>"; 
    foreach($addressTypes as $addressType) {         
        $addressTypesList .= "<option id='$addressType[address_type_id]' value='$addressType[address_type_id]'"; 
        if(isset($addressTypeId)){
            if($addressType['address_type_id'] === $addressTypeId){
                $addressTypesList .= ' selected ';
            }
        } elseif(isset($addressInfo['address_type_id'])) {
            if($addressType['address_type_id'] === $addressInfo['address_type_id']) {
                $addressTypesList .= ' selected ';
            }
        }
        $addressTypesList .= ">$addressType[description]</option>";
    } 
    $addressTypesList .= '</select>'; 
    return $addressTypesList; 
}

function buildCompanyList($companies) {    
    $cp = '<div class="card">';
    $cp .= '<div class="card-body">';
    foreach ($companies as $companyList) {
        $cp .= '<div class="row">';
        $cp .= '<div class="col-sm-8">';
        $cp .= "<h6 class='mb-0 text-secondary'>$companyList[company_name]</h6>";
        $cp .= '</div>';
        $cp .= '<div class="col-sm-4">';
        $cp .= "<a href='/abaonline/actions/index.php?action=view_company&company_id=$companyList[company_id]' title='Edit this company'>View</a> | <a href='/abaonline/actions/index.php?action=edit_company&company_id=$companyList[company_id]' title='Edit this company'>Edit</a> | <a href='/abaonline/actions/index.php?action=delete_company&company_id=$companyList[company_id]' title='Delete this company'>Delete</a>";
        $cp .= '</div>';
        $cp .= '</div>';
        $cp .= '<hr>';
    }
    $cp .= '</div>';
    $cp .= '</div>';
    return $cp;
}

function buildCompanyDisplay($companyInfos) {
    $pd = '<h1 class="text-center font-weight-bold">FEATURED BUSINESS LISTINGS</h1>';
    $pd .= '<div class="row>';
    foreach ($companyInfos as $companyData) {        
        $pd .= '<div class="col-md-4">';
        $pd .= '<div class="card company-card">';
        $pd .= '<div class="card-body">';
        $pd .= "<a class='container' href='/abaonline/actions/index.php?action=view_company&company_id=$companyData[company_id]' title='Click to view this company'>";
        $pd .= "<img src='https://bootdey.com/img/Content/avatar/avatar7.png' alt='Admin' class='rounded-circle'>";
        $pd .= '<hr>';
        $pd .= "<h2>$companyData[company_name]</h2>";
        $pd .= "<span>$companyData[company_summary]</span>";
        $pd .= "</a>";
        $pd .= '</div>';
        $pd .= '</div>';
        $pd .= '</div>';
    }
    $pd .= '</div>';
    return $pd;
}