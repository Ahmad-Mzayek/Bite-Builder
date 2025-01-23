CREATE TABLE IF NOT EXISTS users
(
   id                      INT            NOT NULL    AUTO_INCREMENT,
   username                VARCHAR(32)    NOT NULL,
   email                   VARCHAR(64)    NOT NULL,
   phone_number            VARCHAR(16),
   hashed_password         CHAR(64)       NOT NULL,
   is_male                 BOOLEAN        NOT NULL    DEFAULT TRUE,
   username_last_updated   DATETIME       NOT NULL    DEFAULT CURRENT_TIMESTAMP,

   CONSTRAINT primary_key_users PRIMARY KEY (id)
);