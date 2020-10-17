<?php
/*
    aba-online model for site visitors
*/

function regBusinessOwner($userName, $password, $firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated) {
    // Create a connection object using the aba-online connection function
    $db = abaOnlineConnect();
    // The SQL statement
     $sql = '
       WITH boidkey AS 
            (
              INSERT INTO business_owner 
              (
                first_name
              , middle_name
              , last_name
              , gender
              , email_address
              , entity_type_td
              , update_date)
              VALUES 
              (
                :firstName
              , :middleName
              , :lastName
              , :gender
              , :emailAddress
              , :entityTypeId
              , :updateDate
              ) 
              RETURNING businessownerid
            ),
            cdkey AS
            (
              INSERT INTO contact_detail 
              (
                contact_type_id
              , reference_id
              , entity_type_id
              , contact_data
              , created_by
              , update_date
              , update_by
              )
              VALUES 
              (
                :contactTypeId
                , (SELECT businessownerid FROM boidkey)
                , :entityTypeId
                , :contactData
                , (SELECT businessownerid FROM boidkey)
                , :updateDate
                , (SELECT businessownerid FROM boidkey)
              )
            ),
            addkey AS 
            (
              INSERT INTO address_detail 
              (
                address_type_id
              , reference_id
              , entity_type_id
              , address
              , city
              , state_located
              , created_by
              , update_date
              , update_by
              )
              VALUES 
              (
                :addressTypeId
              , (SELECT businessownerid FROM boidkey)
              , :entityTypeId
              , :address
              , :city
              , :stateLocated
              , (SELECT businessownerid FROM boidkey)
              , updateDate
              , (SELECT businessownerid FROM boidkey)
              )
            )
            INSERT INTO user_login 
            (
              reference_id
            , user_name
            , password
            , user_role_id
            , created_by
            , update_date
            , update_by
            )
            VALUES 
            (
              (SELECT businessownerid FROM boidkey)
            , :userName
            , :password
            , :userRoleId
            , (SELECT businessownerid FROM boidkey)
            , updateDate
            , (SELECT businessownerid FROM boidkey)
          );
    ';
    // Get entityTypeID, updateDate, and userRole
    $entityTypeId = "
        SELECT 
          entity_type_id 
        FROM entity_type 
        WHERE entity_type_id = '1';
      ";
    date_default_timezone_set('Africa/Accra'); 
    $updateDate = date("Y-m-d H:i:s");
    $userRoleId = "
        SELECT 
          user_role_id 
        FROM user_role 
        WHERE user_role_id = '1';
      ";
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
    $sql = '
        SELECT 
          user_name 
        FROM user_login 
        WHERE user_name = :userName;
      ';
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
    $sql = '
        SELECT 
          first_name
        , middle_name
        , last_name
        , gender
        , email_address
        , user_name
        , contact_data
        , address
        , city
        , state_located
        , user_role_id
        , password
        FROM business_owner bo 
			    JOIN user_login ul ON ul.reference_id = bo.business_owner_id
          JOIN contact_detail cd ON cd.reference_id = bo.business_owner_id 
          JOIN address_detail ad ON ad.reference_id = bo.business_owner_id
        WHERE user_name = :userName;
      ';
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
  $sql = '
    SELECT 
      address_type_id
    , description 
    FROM address_type 
    ORDER BY description ASC;
  '; 
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
  $sql = '
    SELECT 
      contact_type_id
    , description 
    FROM contact_type 
    ORDER BY description ASC;
  '; 
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
