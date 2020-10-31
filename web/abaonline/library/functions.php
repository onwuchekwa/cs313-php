<?php

// Check if Email Address is valid
function checkEmail($emailAddress){
    $valEmail = filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
    return $valEmail;
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
    print_r($companies);
    exit;
    foreach($companies as $company) {
        $cp .= '<div class="row">';
        $cp .= '<div class="col-sm-8">';
        $cp .= "<h6 class='mb-0 text-secondary'>$company[company_name]</h6>";
        $cp .= '</div>';
        $cp .= '<div class="col-sm-4">';
        $cp .= "<a href='/abaonline/actions/index.php?action=view_company&company_id=$company[company_id]' title='Edit this company'>View</a> | <a href='/abaonline/actions/index.php?action=edit_company&company_id=$company[company_id]' title='Edit this company'>Edit</a> | <a href='/abaonline/actions/index.php?action=delete_company&company_id=$company[company_id]' title='Delete this company'>Delete</a>";
        $cp .= '</div>';
        $cp .= '</div>';
        $cp .= '<hr>';
    }
    $cp .= '</div>';
    $cp .= '</div>';
    return $cp;
}