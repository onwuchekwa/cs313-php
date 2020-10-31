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
            echo $contactTypeId; exit;
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