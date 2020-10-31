-------------------------------------------------------------------
-- CREATE system_admin TABLE
-------------------------------------------------------------------
DROP TABLE system_admin CASCADE;

CREATE TABLE system_admin
(
  system_admin_id SERIAL PRIMARY KEY
, system_admin_name VARCHAR(50) NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, update_date TIMESTAMP NOT NULL
);

INSERT INTO system_admin (
  system_admin_name
, update_date
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
  category_id SERIAL PRIMARY KEY
, category_name VARCHAR(255) UNIQUE NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_category_admin_1 FOREIGN KEY(created_by) 
    REFERENCES system_admin (system_admin_id)
, CONSTRAINT fk_category_admin_2 FOREIGN KEY(update_by) 
    REFERENCES system_admin (system_admin_id)
);

INSERT INTO category (
  category_name
, created_by
, update_date
, update_by
)
VALUES
(
  'Oil and Gas'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Information and Communication Technology'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Engineering'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Import and Export'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Building'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Security'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
);


-------------------------------------------------------------------
-- CREATE entity_type TABLE
-------------------------------------------------------------------
DROP TABLE entity_type CASCADE;

CREATE TABLE entity_type
(
  entity_type_id SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_entity_admin_1 FOREIGN KEY(created_by) 
    REFERENCES system_admin (system_admin_id)
, CONSTRAINT fk_entity_admin_2 FOREIGN KEY(update_by) 
    REFERENCES system_admin (system_admin_id)
);

INSERT INTO entity_type (
  description
, created_by
, update_date
, update_by
)
VALUES
(
  'Business owner'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Company'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
);

-------------------------------------------------------------------
-- CREATE business_owner TABLE
-------------------------------------------------------------------
DROP TABLE business_owner CASCADE;

CREATE TABLE business_owner
(
  business_owner_id SERIAL PRIMARY KEY
, first_name VARCHAR(25) NOT NULL
, middle_name VARCHAR(25)
, last_name VARCHAR(50) NOT NULL
, gender VARCHAR(1) NOT NULL
, email_address VARCHAR(64) NOT NULL
, entity_type_id INT NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, update_date TIMESTAMP NOT NULL
, CONSTRAINT fk_owner_entity FOREIGN KEY(entity_type_id) 
    REFERENCES entity_type (entity_type_id)
);

-------------------------------------------------------------------
-- CREATE contact_type TABLE
-------------------------------------------------------------------
DROP TABLE contact_type CASCADE;

CREATE TABLE contact_type
(
  contact_type_id SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_contact_admin_1 FOREIGN KEY(created_by) 
    REFERENCES system_admin (system_admin_id)
, CONSTRAINT fk_contact_admin_2 FOREIGN KEY(update_by) 
    REFERENCES system_admin (system_admin_id)
);

INSERT INTO contact_type (
  description
, created_by
, update_date
, update_by
)
VALUES
(
  'Home Phone'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Work Phone'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Mobile Phone'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
);

-------------------------------------------------------------------
-- CREATE contact_detail TABLE
-------------------------------------------------------------------
DROP TABLE contact_detail CASCADE;

CREATE TABLE contact_detail
(
  contact_detail_id SERIAL PRIMARY KEY
, contact_type_id INT NOT NULL
, reference_id INT NOT NULL -- Stores both business owner and Company Number
, entity_type_id INT NOT NULL
, contact_data VARCHAR(20) NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_contact FOREIGN KEY(contact_type_id) 
    REFERENCES contact_type (contact_type_id)
, CONSTRAINT fk_contact_entity FOREIGN KEY(entity_type_id) 
    REFERENCES entity_type (entity_type_id)
, CONSTRAINT fk_contact_business_1 FOREIGN KEY(created_by) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_contact_business_2 FOREIGN KEY(update_by) 
    REFERENCES business_owner (business_owner_id)
);

-------------------------------------------------------------------
-- CREATE address_type  TABLE
-------------------------------------------------------------------
DROP TABLE address_type CASCADE;

CREATE TABLE address_type 
(
  address_type_id SERIAL PRIMARY KEY
, description VARCHAR(20) UNIQUE NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_address_admin_1 FOREIGN KEY(created_by) 
    REFERENCES system_admin (system_admin_id)
, CONSTRAINT fk_address_admin_2 FOREIGN KEY(update_by) 
    REFERENCES system_admin (system_admin_id)
);

INSERT INTO address_type (
  description
, created_by
, update_date
, update_by
)
VALUES
(
  'Residential'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Business'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'Correspondence'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
);


-------------------------------------------------------------------
-- CREATE address_detail  TABLE
-------------------------------------------------------------------
DROP TABLE address_detail CASCADE;

CREATE TABLE address_detail 
(
  address_detail_id SERIAL PRIMARY KEY
, address_type_id INT NOT NULL
, reference_id INT NOT NULL -- Stores both business owner and Company Address
, entity_type_id INT NOT NULL
, address VARCHAR(80) NOT NULL
, city VARCHAR(40) NOT NULL
, state_located VARCHAR(60) NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_address_business_1 FOREIGN KEY(created_by) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_address_business_2 FOREIGN KEY(update_by) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_address FOREIGN KEY(address_type_id) 
    REFERENCES address_type (address_type_id)
, CONSTRAINT fk_address_entity FOREIGN KEY(entity_type_id) 
    REFERENCES entity_type (entity_type_id)
);

-------------------------------------------------------------------
-- CREATE company_detail   TABLE
-------------------------------------------------------------------
DROP TABLE company_detail CASCADE;

CREATE TABLE company_detail 
(
  company_id SERIAL PRIMARY KEY
, business_owner_id INT NOT NULL
, entity_type_id INT NOT NULL
, category_id INT NOT NULL
, company_name VARCHAR(225) NOT NULL
--, company_logo VARCHAR(150)
, company_summary VARCHAR(50) NOT NULL
, company_full_info TEXT NOT NULL
-- , business_hour VARCHAR(150) NOT NULL
, email_address VARCHAR(64) NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_company_business_1 FOREIGN KEY(created_by) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_company_business_2 FOREIGN KEY(update_by) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_category FOREIGN KEY(category_id) 
    REFERENCES category (category_id)
, CONSTRAINT fk_businessOwner FOREIGN KEY(business_owner_id) 
    REFERENCES business_owner (business_owner_id)
, CONSTRAINT fk_company_entity FOREIGN KEY(entity_type_id) 
    REFERENCES entity_type (entity_type_id)
);

-------------------------------------------------------------------
-- CREATE user_role   TABLE
-------------------------------------------------------------------
DROP TABLE user_role CASCADE;

CREATE TABLE user_role 
(
  user_role_id SERIAL PRIMARY KEY
, role VARCHAR(30) NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_user_admin_1 FOREIGN KEY(created_by) 
    REFERENCES system_admin (system_admin_id)
, CONSTRAINT fk_user_admin_2 FOREIGN KEY(update_by) 
    REFERENCES system_admin (system_admin_id)
);

INSERT INTO user_role (
  role
, created_by
, update_date
, update_by
)
VALUES
(
  'user'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
),
(
  'admin'
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
, NOW()
, (SELECT system_admin_id FROM system_admin WHERE system_admin_id = '1')
);

-------------------------------------------------------------------
-- CREATE user_login   TABLE
-------------------------------------------------------------------
DROP TABLE user_login CASCADE;

CREATE TABLE user_login 
(
  user_login_id SERIAL PRIMARY KEY
, user_name VARCHAR(65) UNIQUE NOT NULL 
, password VARCHAR(255) NOT NULL 
, user_role_id INT NOT NULL
, reference_id INT NOT NULL
, create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
, created_by INT NOT NULL
, update_date TIMESTAMP NOT NULL
, update_by INT NOT NULL
, CONSTRAINT fk_user_login FOREIGN KEY(user_role_id) 
    REFERENCES user_role (user_role_id)
);


-- heroku pg:psql