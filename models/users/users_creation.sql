CREATE TABLE IF NOT EXISTS users
(
   id                      INT            NOT NULL    UNIQUE,
   username                VARCHAR(32)    NOT NULL    UNIQUE,
   email_address           VARCHAR(64)    NOT NULL    UNIQUE,
   phone_number            VARCHAR(16)                UNIQUE,
   hashed_password         CHAR(64)       NOT NULL,
   is_male                 BOOLEAN        NOT NULL    DEFAULT TRUE,
   username_last_updated   DATETIME       NOT NULL    DEFAULT CURRENT_TIMESTAMP,

   CONSTRAINT primary_key_users PRIMARY KEY (id),
   CONSTRAINT foreign_key_users_id FOREIGN KEY (id) REFERENCES dietary_filters(id)
);