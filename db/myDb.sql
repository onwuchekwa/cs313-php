-------------------------------------------------------------------
-- CREATE systemAdmin TABLE
-------------------------------------------------------------------
DROP TABLE systemAdmin CASCADE;

CREATE TABLE systemAdmin
(
  systemAdminId SERIAL PRIMARY KEY
, systemAdminName VARCHAR(50) NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, updateDate TIMESTAMP NOT NULL
);

INSERT INTO systemAdmin (
  systemAdminName
, updateDate
)
VALUES
(
  'Sunday Onwuchekwa'
, NOW()
);

-------------------------------------------------------------------
-- CREATE category TABLE
-------------------------------------------------------------------
DROP TABLE category CASCADE;

CREATE TABLE category
(
  categoryId SERIAL PRIMARY KEY
, categoryName VARCHAR(255) UNIQUE NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_category_admin_1 FOREIGN KEY(createdBy) 
    REFERENCES systemAdmin (systemAdminId)
, CONSTRAINT fk_category_admin_2 FOREIGN KEY(updateBy) 
    REFERENCES systemAdmin (systemAdminId)
);

INSERT INTO category (
  categoryName
, createdBy
, updateDate
, updateBy
)
VALUES
(
  'Oil and Gas'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Information and Communication Technology'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Engineering'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Import and Export'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Oil and Gas'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Security'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
);


-------------------------------------------------------------------
-- CREATE entityType TABLE
-------------------------------------------------------------------
DROP TABLE entityType CASCADE;

CREATE TABLE entityType
(
  entityTypeId SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_entity_admin_1 FOREIGN KEY(createdBy) 
    REFERENCES systemAdmin (systemAdminId)
, CONSTRAINT fk_entity_admin_2 FOREIGN KEY(updateBy) 
    REFERENCES systemAdmin (systemAdminId)
);

INSERT INTO category (
  description
, createdBy
, updateDate
, updateBy
)
VALUES
(
  'Business owner'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Company'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
);

-------------------------------------------------------------------
-- CREATE businessOwner TABLE
-------------------------------------------------------------------
DROP TABLE businessOwner CASCADE;

CREATE TABLE businessOwner
(
  businessOwnerId SERIAL PRIMARY KEY
, firstName VARCHAR(25) NOT NULL
, middleName VARCHAR(25)
, lastName VARCHAR(50) NOT NULL
, gender VARCHAR(1) NOT NULL
, emailAddress VARCHAR(64) NOT NULL
, entityTypeId INT NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, updateDate TIMESTAMP NOT NULL
, CONSTRAINT fk_owner_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE contactType TABLE
-------------------------------------------------------------------
DROP TABLE contactType CASCADE;

CREATE TABLE contactType
(
  contactTypeId SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_contact_admin_1 FOREIGN KEY(createdBy) 
    REFERENCES systemAdmin (systemAdminId)
, CONSTRAINT fk_contact_admin_2 FOREIGN KEY(updateBy) 
    REFERENCES systemAdmin (systemAdminId)
);

INSERT INTO contactType (
  description
, createdBy
, updateDate
, updateBy
)
VALUES
(
  'Home Phone'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Work Phone'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Mobile Phone'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
);

-------------------------------------------------------------------
-- CREATE contactDetail TABLE
-------------------------------------------------------------------
DROP TABLE contactDetail CASCADE;

CREATE TABLE contactDetail
(
  contactDetailId SERIAL PRIMARY KEY
, contactTypeId INT NOT NULL
, referenceId INT NOT NULL -- Stores both business owner and Company Number
, entityTypeId INT NOT NULL
, contactData VARCHAR(20) NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_contact FOREIGN KEY(contactTypeId) 
    REFERENCES contactType (contactTypeId)
, CONSTRAINT fk_contact_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
, CONSTRAINT fk_contact_business_1 FOREIGN KEY(createdBy) 
    REFERENCES businessOwner (businessOwnerId)
, CONSTRAINT fk_contact_business_2 FOREIGN KEY(updateBy) 
    REFERENCES businessOwner (businessOwnerId)
);

-------------------------------------------------------------------
-- CREATE addressType  TABLE
-------------------------------------------------------------------
DROP TABLE addressType CASCADE;

CREATE TABLE addressType 
(
  addressTypeId SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_address_admin_1 FOREIGN KEY(createdBy) 
    REFERENCES systemAdmin (systemAdminId)
, CONSTRAINT fk_address_admin_2 FOREIGN KEY(updateBy) 
    REFERENCES systemAdmin (systemAdminId)
);

INSERT INTO addressType (
  description
, createdBy
, updateDate
, updateBy
)
VALUES
(
  'Residential'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Business'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'Correspondence'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
);


-------------------------------------------------------------------
-- CREATE addressDetail  TABLE
-------------------------------------------------------------------
DROP TABLE addressDetail CASCADE;

CREATE TABLE addressDetail 
(
  addressDetailId SERIAL PRIMARY KEY
, addressTypeId INT NOT NULL
, referenceId INT NOT NULL -- Stores both business owner and Company Address
, entityTypeId INT NOT NULL
, address VARCHAR(80) NOT NULL
, city VARCHAR(40) NOT NULL
, stateLocated VARCHAR(60) NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_address_business_1 FOREIGN KEY(createdBy) 
    REFERENCES businessOwner (businessOwnerId)
, CONSTRAINT fk_address_business_2 FOREIGN KEY(updateBy) 
    REFERENCES businessOwner (businessOwnerId)
, CONSTRAINT fk_address FOREIGN KEY(addressTypeId) 
    REFERENCES addressType (addressTypeId)
, CONSTRAINT fk_address_entity FOREIGN KEY(entityTypeId) 
    REFERENCES entityType (entityTypeId)
);

-------------------------------------------------------------------
-- CREATE companyDetail   TABLE
-------------------------------------------------------------------
DROP TABLE companyDetail CASCADE;

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
, emailAddress VARCHAR(64) NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_company_business_1 FOREIGN KEY(createdBy) 
    REFERENCES businessOwner (businessOwnerId)
, CONSTRAINT fk_company_business_2 FOREIGN KEY(updateBy) 
    REFERENCES businessOwner (businessOwnerId)
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
DROP TABLE userRole CASCADE;

CREATE TABLE userRole 
(
  userRoleId SERIAL PRIMARY KEY
, role VARCHAR(30) NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_user_admin_1 FOREIGN KEY(createdBy) 
    REFERENCES systemAdmin (systemAdminId)
, CONSTRAINT fk_user_admin_2 FOREIGN KEY(updateBy) 
    REFERENCES systemAdmin (systemAdminId)
);

INSERT INTO userRole (
  role
, createdBy
, updateDate
, updateBy
)
VALUES
(
  'user'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
),
(
  'admin'
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
, NOW()
, (SELECT systemAdminId FROM systemAdmin WHERE systemAdminId = '1')
);

-------------------------------------------------------------------
-- CREATE userLogin   TABLE
-------------------------------------------------------------------
DROP TABLE userLogin CASCADE;

CREATE TABLE userLogin 
(
  userLoginId SERIAL PRIMARY KEY
, userName VARCHAR(65) UNIQUE NOT NULL 
, password VARCHAR(255) NOT NULL 
, userRoleId INT NOT NULL
, createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, createdBy INT NOT NULL
, updateDate TIMESTAMP NOT NULL
, updateBy INT NOT NULL
, CONSTRAINT fk_user_login FOREIGN KEY(userRoleId) 
    REFERENCES userRole (userRoleId)
);