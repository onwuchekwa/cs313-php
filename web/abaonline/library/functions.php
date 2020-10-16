<?php

// Check if Email Address is valid
function checkEmail($emailAddress){
    $valEmail = filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}