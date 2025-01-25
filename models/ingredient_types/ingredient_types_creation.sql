CREATE TABLE IF NOT EXISTS ingredient_types
(
   id       INT            NOT NULL    AUTO_INCREMENT,
   name     VARCHAR(32)    NOT NULL    UNIQUE,

   CONSTRAINT primary_key_ingredient_types PRIMARY KEY (id)
);