<?php
/*
    aba-online model for site visitors
*/

function regBusinessOwner($userName, $password, $firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated) { 
    // Create a connection object using the aba-online connection function
    $db = abaOnlineConnect();
    // The SQL statement
     $sql = 'WITH boidkey AS 
     (
       INSERT INTO business_owner (first_name, middle_name, last_name, gender, email_address, entity_type_id, update_date)
       VALUES (:firstName, :middleName, :lastName, :gender, :emailAddress, 1, NOW()) 
       RETURNING business_owner_id
     ),
     cdkey AS
     (
       INSERT INTO contact_detail (contact_type_id, reference_id, entity_type_id, contact_data, created_by, update_date, update_by)
       VALUES (:contactTypeId, (SELECT business_owner_id FROM boidkey), 1, :contactData, (SELECT business_owner_id FROM boidkey), NOW(), (SELECT business_owner_id FROM boidkey))
     ),
     addkey AS 
     (
       INSERT INTO address_detail (address_type_id, reference_id, entity_type_id, address, city, state_located, created_by, update_date, update_by)
       VALUES (:addressTypeId, (SELECT business_owner_id FROM boidkey), 1, :address, :city, :stateLocated, (SELECT business_owner_id FROM boidkey), NOW(), (SELECT business_owner_id FROM boidkey)) 
     )
     INSERT INTO user_login (reference_id, user_name, password, user_role_id, created_by, update_date, update_by)
     VALUES ((SELECT business_owner_id FROM boidkey), :userName, :password, 1, (SELECT business_owner_id FROM boidkey), NOW(), (SELECT business_owner_id FROM boidkey));';

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
          bo.business_owner_id
        , first_name
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
        , contact_detail_id
        , address_detail_id
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

// Update Business owner information
function updateBusinessOwnerInfo($firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated, $businessOwnerId, $addressId, $contactId) {
  // Create a connection object using the acme connection function
  $db = abaOnlineConnect();
  // The SQL statement
  $sql = 'WITH updateBusinessOwner AS
  ( 
    UPDATE business_owner SET first_name = :firstName, middle_name = :middleName, last_name = :lastName, gender = :gender, email_address = :emailAddress, update_date = NOW() WHERE business_owner_id = :businessOwnerId
  ),
  updateContact AS
  (
    UPDATE contact_detail SET contact_data = :contactData, contact_type_id = :contactTypeId, update_date = NOW(), update_by = :businessOwnerId WHERE contact_detail_id = :contactId
  )
  UPDATE address_detail SET address_type_id = :addressTypeId, address = :address, city = :city, state_located = :stateLocated, update_date = NOW(), update_by = :businessOwnerId WHERE address_detail_id = :addressId;';
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
    $stmt->bindValue(':contactTypeId', $contactTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':contactData', $contactData, PDO::PARAM_STR);
    $stmt->bindValue(':addressTypeId', $addressTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':stateLocated', $stateLocated, PDO::PARAM_STR);
    $stmt->bindValue(':addressId', $addressId, PDO::PARAM_STR);
    $stmt->bindValue(':contactId', $contactId, PDO::PARAM_STR);
    $stmt->bindValue(':businessOwnerId', $businessOwnerId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

function deleteBusinessOwner($businessOwnerId, $userName, $addressId, $contactId) {
  $db = abaOnlineConnect();
  $sql = 'WITH deleteCredential AS
  (
    DELETE FROM user_login WHERE user_name = :userName
  ),
  deleteAddress AS 
  (
    DELETE FROM address_detail WHERE address_detail_id = :addressId
  ),
  deleteContact AS 
  (
    DELETE FROM contact_detail WHERE contact_detail_id = :contactId
  )
  DELETE FROM business_owner WHERE business_owner_id = :businessOwnerId;';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':businessOwnerId', $businessOwnerId, PDO::PARAM_INT);
  $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
  $stmt->bindValue(':addressId', $addressId, PDO::PARAM_INT);
  $stmt->bindValue(':contactId', $contactId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getCategory() {
  // Create a connection object from the acme connection function
  $db = abaOnlineConnect(); 
  // The SQL statement to be used with the database 
  $sql = 'SELECT category_id, category_name FROM category ORDER BY category_name ASC'; 
  // The next line creates the prepared statement using the abaonlinedirect connection      
  $stmt = $db->prepare($sql);
  // The next line runs the prepared statement 
  $stmt->execute(); 
  // The next line gets the data from the database and 
  // stores it as an array in the $category variable 
  $category = $stmt->fetchAll(); 
  // The next line closes the interaction with the database 
  $stmt->closeCursor(); 
  // The next line sends the array of data back to where the function 
  // was called (this should be the controller) 
  return $category;
}

function regBusiness($company_name, $company_full_info, $company_summary, $email_address, $category_id, $reference_id, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated) { 
  // Create a connection object using the aba-online connection function
  $db = abaOnlineConnect();
  // The SQL statement
   $sql = 'WITH comidkey AS 
   (
     INSERT INTO company_detail (business_owner_id, entity_type_id, category_id, company_name, company_summary, company_full_info, email_address, created_by, update_date, update_by)
     VALUES (:business_owner_id, 2, :category_id, :company_name, :company_summary, :company_full_info, :email_address, :business_owner_id, NOW(), :business_owner_id) 
     RETURNING company_id
   ),
   cdckey AS
   (
     INSERT INTO contact_detail (contact_type_id, reference_id, entity_type_id, contact_data, created_by, update_date, update_by)
     VALUES (:contactTypeId, (SELECT company_id FROM comidkey), 2, :contactData, :business_owner_id, NOW(), :business_owner_id)
   )
   INSERT INTO address_detail (address_type_id, reference_id, entity_type_id, address, city, state_located, created_by, update_date, update_by)
   VALUES (:addressTypeId, (SELECT company_id FROM comidkey), 2, :address, :city, :stateLocated, :business_owner_id, NOW(), :business_owner_id);';

  // Create the prepared statement using the acme connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':business_owner_id', $reference_id, PDO::PARAM_STR);
  $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
  $stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR);
  $stmt->bindValue(':company_summary', $company_summary, PDO::PARAM_STR);
  $stmt->bindValue(':company_full_info', $company_full_info, PDO::PARAM_STR);
  $stmt->bindValue(':email_address', $email_address, PDO::PARAM_STR);
  $stmt->bindValue(':contactTypeId', $contactTypeId, PDO::PARAM_STR);
  $stmt->bindValue(':contactData', $contactData, PDO::PARAM_STR);
  $stmt->bindValue(':addressTypeId', $addressTypeId, PDO::PARAM_STR);
  $stmt->bindValue(':address', $address, PDO::PARAM_STR);
  $stmt->bindValue(':city', $city, PDO::PARAM_STR);
  $stmt->bindValue(':stateLocated', $stateLocated, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;       
}

function getCompanyInfoByOwner($businessOwnerId) {
  $db = abaOnlineConnect();
  $sql = 'SELECT company_id, company_name FROM company_detail WHERE business_owner_id = :business_owner_id ORDER BY company_name';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':business_owner_id', $businessOwnerId, PDO::PARAM_INT);
  $stmt->execute();
  $companyInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $companyInfo;
}

function updateBusinessOwnerPassword($hashedPassword, $userName) {
  // Create a connection object using the acme connection function
  $db = abaOnlineConnect();
  // The SQL statement
  $sql = 'UPDATE user_login SET password = :password WHERE user_name = :user_name';
  // Create the prepared statement using the acme connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':user_name', $userName, PDO::PARAM_STR);
  $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;    
}

function getCompanyInfo($company_id) {
  // Create a connection object using the acme connection function
  $db = abaOnlineConnect();
  // The SQL statement
  $sql = '
      SELECT
        co.business_owner_id
      , company_id
      , category_id
      , company_name
      , company_summary
      , email_address
      , company_full_info
      , contact_data
      , email_address
      , address
      , city
      , state_located
      , contact_detail_id
      , address_detail_id
      FROM company_detail co 
        JOIN contact_detail cd ON cd.reference_id = co.business_owner_id 
        JOIN address_detail ad ON ad.reference_id = co.business_owner_id
      WHERE company_id = :company_id;
    ';
  // Create the prepared statement using the aba-online connection
  $stmt = $db->prepare($sql);
  // The next line replace the placeholder in the SQL
  $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
  // Retrieve the data
  $stmt->execute();
  $companyData = $stmt->fetch(PDO::FETCH_ASSOC);
  // Close cursor
  $stmt->closeCursor();
  // Return Client Data
  return $companyData;
}

function updateCompanyInfo($company_name, $company_summary, $company_full_info, $email_address, $category_id, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated, $company_id, $addressId, $contactId) {
  // Create a connection object using the acme connection function
  $db = abaOnlineConnect();
  // The SQL statement
  $sql = 'WITH updateBusinessOwner AS
  ( 
    UPDATE company_detail SET company_name = :company_name, company_summary = :company_summary, company_full_info = :company_full_info, category_id = :category_id, email_address = :email_address, update_date = NOW() WHERE company_id = :company_id
  ),
  updateContact AS
  (
    UPDATE contact_detail SET contact_data = :contactData, contact_type_id = :contactTypeId, update_date = NOW() WHERE contact_detail_id = :contactId
  )
  UPDATE address_detail SET address_type_id = :addressTypeId, address = :address, city = :city, state_located = :stateLocated, update_date = NOW() WHERE address_detail_id = :addressId;';
  // Create the prepared statement using the acme connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
    $stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR);
    $stmt->bindValue(':company_summary', $company_summary, PDO::PARAM_STR);
    $stmt->bindValue(':company_full_info', $company_full_info, PDO::PARAM_STR);
    $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
    $stmt->bindValue(':email_address', $email_address, PDO::PARAM_STR);
    $stmt->bindValue(':contactTypeId', $contactTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':contactData', $contactData, PDO::PARAM_STR);
    $stmt->bindValue(':addressTypeId', $addressTypeId, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':stateLocated', $stateLocated, PDO::PARAM_STR);
    $stmt->bindValue(':addressId', $addressId, PDO::PARAM_STR);
    $stmt->bindValue(':contactId', $contactId, PDO::PARAM_STR);
    $stmt->bindValue(':company_id', $company_id, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

function deleteCompanyData($company_id, $del_address_detail_id, $del_contact_detail_id) {
  $db = abaOnlineConnect();
  $sql = 'WITH deleteAddress AS 
  (
    DELETE FROM address_detail WHERE address_detail_id = :del_address_detail_id
  ),
  deleteContact AS 
  (
    DELETE FROM contact_detail WHERE contact_detail_id = :del_contact_detail_id
  )
  DELETE FROM company_detail WHERE company_id = :company_id;';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
  $stmt->bindValue(':del_address_detail_id', $del_address_detail_id, PDO::PARAM_INT);
  $stmt->bindValue(':del_contact_detail_id', $del_contact_detail_id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getCompanyInfoHome() {
  // Create a connection object using the acme connection function
  $db = abaOnlineConnect();
  // The SQL statement
  $sql = '
      SELECT
        company_id
      , company_name
      , company_summary
      FROM company_detail
      ORDER BY create_date DESC
      LIMIT 12;
    ';
  // Create the prepared statement using the aba-online connection
  $stmt = $db->prepare($sql);
  // Retrieve the data
  $stmt->execute();
  $companyHomeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // Close cursor
  $stmt->closeCursor();
  // Return Client Data
  return $companyHomeData;
}