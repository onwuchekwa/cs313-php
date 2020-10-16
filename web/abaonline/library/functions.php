<?php

// Check if Email Address is valid
function checkEmail($emailAddress){
    $valEmail = filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Build the contact type select list 
function buildContactTypeList($contactTypes) {
    $contactTypeList = '<select id="contactTypeId" name="contactTypeId" class="form-control" required>'; 
    $contactTypeList .= "<option value='' selected>Choose Contact Type</option>"; 
    foreach ($contactTypes as $contactType) { 
    $contactTypeList .= "<option value='$contactType[contactTypeId]'>$contactType[description]</option>"; 
    } 
    $contactTypeList .= '</select>'; 
    return $contactTypeList; 
}

// Build the address type select list 
function buildAddressTypeList($addressTypes) {
    $addressTypesList = '<id="addressTypeId" name="addressTypeId" class="form-control" required>'; 
    $addressTypesList .= "<option value='' selected>Choose Address Type</option>"; 
    foreach ($addressTypes as $addressType) { 
    $addressTypesList .= "<option value='$addressType[addressTypeId]'>$addressType[description]</option>"; 
    } 
    $addressTypesList .= '</select>'; 
    return $addressTypesList; 
}