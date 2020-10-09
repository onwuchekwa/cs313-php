--Creating tables 
CREATE TABLE "talks" (
  "talk_id" int8,
  "session_id" varchar,
  "speaker_id" varchar,
  "talk_name" varchar,
  PRIMARY KEY ("talk_id")
);

CREATE TABLE "speakers" (
  "speaker_id" int8,
  "name" varchar,
  "last_name" varchar,
  "Calling" varchar,
  PRIMARY KEY ("speaker_id")
);

CREATE TABLE "notes" (
  "note_id" int8,
  "talk_id" int8,
  "user_id" int8,
  "sepeaker_id" int8,
  "notes_content" varchar,
  PRIMARY KEY ("note_id")
);

CREATE TABLE "sessions" (
  "session_id" int8,
  "conference_id" int8,
  "session_type_id" int8,
  PRIMARY KEY ("session_id")
);

CREATE TABLE "conference" (
  "conference_id" int8,
  "Year" varchar,
  "Month" varchar,
  PRIMARY KEY ("conference_id")
);

CREATE TABLE "session_type" (
  "session_type_id" int8,
  "type_name" varchar,
  PRIMARY KEY ("session_type_id")
);

CREATE TABLE "users" (
  "user_id" int8,
  "user_name" varchar,
  "name" varchar,
  "last_name" varchar,
  PRIMARY KEY ("user_id")
);

--Creating sequences 
CREATE SEQUENCE users_sequence START 001;
CREATE SEQUENCE speakers_sequence START 001;
CREATE SEQUENCE conference_sequence START 001;
CREATE SEQUENCE session_types_sequence START 001;
CREATE SEQUENCE session_sequence START 001;
CREATE SEQUENCE talks_sequence START 001;
CREATE SEQUENCE notes_sequence START 001;

--Creating one user 
INSERT INTO users VALUES(
  (select nextval('users_sequence')),
  'aguil26',
  'Nefi',
  'Aguilar'
);

--Creating three speakers 
INSERT INTO speakers VALUES(
  nextval('speakers_sequence'),
  'Scott',
  'Whiting',
  'Seventy'
);


INSERT INTO speakers VALUES(
  nextval('speakers_sequence'),
  'David',
  'Bednar',
  'Apostle'
);

INSERT INTO speakers VALUES(
  nextval('speakers_sequence'),
  'Russell',
  'Nelson',
  'President and Prohet'
);

--Crete a conference 
INSERT INTO conference VALUES(
  nextval('conference_sequence'),
  '2020',
  'October'
);


--Crete session types  
INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Saturday Morning'
);

INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Saturday Afternoon'
);

INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Sunday Morning'
);

INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Sunday Afternoon'
);

INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Women’s Session'
);

INSERT INTO session_type VALUES(
  nextval('session_types_sequence'),
  'Man’s Session'
);

--Create session
INSERT INTO sessions VALUES(
  nextval('session_sequence'),
  CURRVAL('conference_sequence'),
  (select session_type_id 
  from  session_type 
  where type_name = 'Saturday Morning')
);


--Create a talk 
INSERT INTO talks VALUES(
  nextval('talks_sequence'),
  CURRVAL('session_sequence'),
  (Select speaker_id 
  from speakers
  where name = 'Russell'
  and last_name = 'Nelson'),
  'Moving Forward'
);


--Create notes 
INSERT INTO notes VALUES(
  nextval('notes_sequence'),
  (Select talk_id 
  from talks 
  where speaker_id::INTEGER = (select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson')), 
  (select user_id
  from users
  where name = 'Nefi'), 
  (Select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson'), 
  'This talk is amazing'
);

INSERT INTO notes VALUES(
  nextval('notes_sequence'),
  (Select talk_id 
  from talks 
  where speaker_id::INTEGER = (Select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson')), 
  (select user_id
  from users
  where name = 'Nefi'), 
  (Select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson'), 
  'This talk is awesome'
);

INSERT INTO "notes" VALUES(
  nextval('notes_sequence'),
  (Select talk_id 
  from talks 
  where speaker_id::INTEGER =   (Select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson')), 
  (select user_id
  from users
  where name = 'Nefi'), 
  (Select speaker_id 
  from speakers
  where name =  'Russell'
  and last_name = 'Nelson'), 
  'This is another note'
);

--Query Notes 
select * from notes 


