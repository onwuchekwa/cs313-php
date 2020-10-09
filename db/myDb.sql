-------------------------------------------------------------------
-- CREATE category TABLE
-------------------------------------------------------------------
CREATE TABLE category
(
  categoryId SERIAL PRIMARY KEY
, categoryName VARCHAR(50) UNIQUE NOT NULL
);

-------------------------------------------------------------------
-- CREATE entityType TABLE
-------------------------------------------------------------------
CREATE TABLE entityType
(
  entityTypeId SERIAL PRIMARY KEY
, description VARCHAR(15) UNIQUE NOT NULL
);

-------------------------------------------------------------------
-- CREATE businessOwner TABLE
-------------------------------------------------------------------
CREATE TABLE businessOwner
(
  businessOwnerId SERIAL PRIMARY KEY
, firstName VARCHAR(25) NOT NULL
, middleName VARCHAR(25)
, lastName VARCHAR(50) NOT NULL
, gender VARCHAR(1) NOT NULL
, entityTypeId INT NOT NULL
, CONSTRAINT fk_owner_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE contactType TABLE
-------------------------------------------------------------------
CREATE TABLE contactType
(
  contactTypeId SERIAL PRIMARY KEY
, contactTypeCode VARCHAR(2) UNIQUE NOT NULL
, description VARCHAR(15) UNIQUE NOT NULL
);

-------------------------------------------------------------------
-- CREATE contactDetail TABLE
-------------------------------------------------------------------
CREATE TABLE contactDetail
(
  contactDetailId SERIAL PRIMARY KEY
, contactTypeId INT NOT NULL
, referenceId INT NOT NULL -- Stores both business owner and Company Number
, entityTypeId INT NOT NULL
, contactData VARCHAR(20) NOT NULL
, CONSTRAINT fk_contact FOREIGN KEY(contactTypeId) 
    REFERENCES contactType (contactTypeId)
, CONSTRAINT fk_contact_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE addressType  TABLE
-------------------------------------------------------------------
CREATE TABLE addressType 
(
  addressTypeId SERIAL PRIMARY KEY
, addressTypeCode VARCHAR(3) UNIQUE NOT NULL
, description VARCHAR(15) UNIQUE NOT NULL
);

-------------------------------------------------------------------
-- CREATE addressDetail  TABLE
-------------------------------------------------------------------
CREATE TABLE addressDetail 
(
  addressDetailId SERIAL PRIMARY KEY
, addressTypeId INT NOT NULL
, referenceId INT NOT NULL -- Stores both business owner and Company Address
, entityTypeId INT NOT NULL
, address VARCHAR(80) NOT NULL
, city VARCHAR(40) NOT NULL
, stateLocated VARCHAR(60) NOT NULL
, CONSTRAINT fk_address FOREIGN KEY(addressTypeId) 
    REFERENCES addressType (addressTypeId)
, CONSTRAINT fk_address_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE companyDetail   TABLE
-------------------------------------------------------------------
CREATE TABLE companyDetail 
(
  companyId SERIAL PRIMARY KEY
, businessOwnerId INT NOT NULL
, entityTypeId INT NOT NULL
, categoryId INT NOT NULL
, companyName VARCHAR(225) NOT NULL
, companyLogo VARCHAR(150)
, companySummary VARCHAR(50) NOT NULL
, companyFullInfo TEXT NOT NULL
, businessHour VARCHAR(150) NOT NULL
, CONSTRAINT fk_category FOREIGN KEY(categoryId) 
    REFERENCES category (categoryId)
, CONSTRAINT fk_businessOwner FOREIGN KEY(businessOwnerId) 
    REFERENCES businessOwner (businessOwnerId)
, CONSTRAINT fk_company_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE userRole   TABLE
-------------------------------------------------------------------
CREATE TABLE userRole 
(
  userRoleId SERIAL PRIMARY KEY
, role VARCHAR(30) NOT NULL
);

-------------------------------------------------------------------
-- CREATE userLogin   TABLE
-------------------------------------------------------------------
CREATE TABLE userLogin 
(
  userLoginId SERIAL PRIMARY KEY
, userName VARCHAR(65) UNIQUE NOT NULL 
, userRoleId INT NOT NULL
, CONSTRAINT fk_user_login FOREIGN KEY(userRoleId) 
    REFERENCES userRole (userRoleId)
);