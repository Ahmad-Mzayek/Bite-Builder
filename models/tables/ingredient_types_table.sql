DROP TABLE IF EXISTS ingredient_types;

CREATE TABLE ingredient_types
(
   type_name   VARCHAR(32)    NOT NULL    UNIQUE,

   CONSTRAINT primary_key_ingredient_types
   PRIMARY KEY (type_name)
);