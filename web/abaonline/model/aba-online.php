<?php
/*
    aba-online model for site visitors
*/

function regBusinessOwner($userName, $password, $firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated) {
    // Create a connection object using the aba-online connection function
    $db = abaOnlineConnect();
    // The SQL statement
     $sql = '
       WITH boIdKey AS 
              (INSERT INTO businessOwner (firstName, middleName, lastName, gender, emailAddress, entityTypeId, updateDate)
                VALUES (:firstName, :middleName, :lastName, :gender, :emailAddress, :entityTypeId, :updateDate) RETURNING businessOwnerId),
            cdKey AS
              (INSERT INTO contactDetail (contactTypeId, referenceId, entityTypeId, contactData, createdBy, updateDate, updateBy)
                VALUES (:contactTypeId, boIdKey.businessOwnerId, :entityTypeId, :contactData, boIdKey.businessOwnerId, :updateDate, boIdKey.businessOwnerId)),
            addKey AS 
              (INSERT INTO addressDetail (addressTypeId, referenceId, entityTypeId, address, city, stateLocated, createdBy, updateDate, updateBy)
              VALUES (:addressTypeId, boIdKey.businessOwnerId,:entityTypeId, :address, :city, :stateLocated, boIdKey.businessOwnerId, updateDate, boIdKey.businessOwnerId))
            INSERT INTO userLogin (userName, password, userRoleId, createdBy, updateDate, updateBy)
              VALUES (:userName, :password, :userRoleId, boIdKey.businessOwnerId, updateDate, boIdKey.businessOwnerId);
    ';
    // Get entityTypeID, updateDate, and userRole
    $entityTypeId = "SELECT entityTypeId FROM entityType WHERE entityTypeId = '1';";
    date_default_timezone_set('Africa/Accra'); 
    $updateDate = date("Y-m-d H:i:s");
    $userRoleId = "SELECT userRoleId FROM userRole WHERE userRoleId = '1';";
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':middleName', $middleName, PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);
    $stmt->bindValue(':entityTypeId', $entityTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':updateDate', $updateDate, PDO::PARAM_STR);
    $stmt->bindValue(':userRoleId', $userRoleId, PDO::PARAM_STR);
    $stmt->bindValue(':contactTypeId', $contactTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':contactData', $contactData, PDO::PARAM_STR);
    $stmt->bindValue(':addressTypeId', $addressTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':stateLocated', $stateLocated, PDO::PARAM_STR);
    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;       
}

// Check for an existing username
function checkExistingUsername($userName) {
    // Create a connection object using the acme connection function
    $db = abaOnlineConnect();
    // The SQL statement
    $sql = 'SELECT userName FROM businessOwner WHERE userName = :userName';
    // Create the prepared statement using the aba-online connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    // Retrieve the data
    $stmt->execute();
    $matchUserName = $stmt->fetch(PDO::FETCH_NUM);
    // Close cursor
    $stmt->closeCursor();
    // Check if username already exist
    if(empty($matchUserName)){
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getBusinessOwner($userName){
    // Create a connection object using the acme connection function
    $db = abaOnlineConnect();
    // The SQL statement
    $sql = 'SELECT firstName, middleName, lastName, gender, emailAddress, userName, 
              contactData, `address`, city, stateLocated, userRoleId, `password`
            FROM businessOwner bo 
              JOIN contactDetail cd ON cd.referenceId = bo.businessOwnerId 
              JOIN addressDetail ad ON ad.referenceId = bo.businessOwnerId
            WHERE userName = :userName';
    // Create the prepared statement using the aba-online connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    // Retrieve the data
    $stmt->execute();
    $businessOwnerData = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close cursor
    $stmt->closeCursor();
    // Return Client Data
    return $businessOwnerData;
}

function getAddressType() {
  // Create a connection object from the acme connection function
  $db = abaOnlineConnect(); 
  // The SQL statement to be used with the database 
  $sql = 'SELECT addressTypeId, `description` FROM addressType ORDER BY `description` ASC'; 
  // The next line creates the prepared statement using the acme connection      
  $stmt = $db->prepare($sql);
  // The next line runs the prepared statement 
  $stmt->execute(); 
  // The next line gets the data from the database and 
  // stores it as an array in the $addressTypes variable 
  $addressTypes = $stmt->fetchAll(); 
  // The next line closes the interaction with the database 
  $stmt->closeCursor(); 
  // The next line sends the array of data back to where the function 
  // was called (this should be the controller) 
  return $addressTypes;
}

function getContactType() {
  // Create a connection object from the acme connection function
  $db = abaOnlineConnect(); 
  // The SQL statement to be used with the database 
  $sql = 'SELECT contactTypeId, `description` FROM contactType ORDER BY `description` ASC'; 
  // The next line creates the prepared statement using the acme connection      
  $stmt = $db->prepare($sql);
  // The next line runs the prepared statement 
  $stmt->execute(); 
  // The next line gets the data from the database and 
  // stores it as an array in the $addressTypes variable 
  $contactTypes = $stmt->fetchAll(); 
  // The next line closes the interaction with the database 
  $stmt->closeCursor(); 
  // The next line sends the array of data back to where the function 
  // was called (this should be the controller) 
  return $contactTypes;
}
