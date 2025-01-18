CREATE TABLE IF NOT EXISTS Users
(
   id                    INT AUTO_INCREMENT NOT NULL,
   username              VARCHAR(32)        NOT NULL,
   email                 VARCHAR(64)        NOT NULL,
   phone_number          NUMERIC,
   hashed_password       CHAR(64)           NOT NULL,
   is_male               BOOLEAN            NOT NULL,
   username_last_updated DATETIME           NOT NULL,
   CONSTRAINT USERS_PK PRIMARY KEY (id)
);