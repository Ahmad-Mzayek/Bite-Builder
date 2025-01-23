CREATE TABLE IF NOT EXISTS ingredients
(
   id          INT            NOT NULL    AUTO_INCREMENT,
   type_id     INT            NOT NULL,
   name        VARCHAR(32)    NOT NULL,
   unit        VARCHAR(16)    NOT NULL,

   CONSTRAINT primary_key_ingredients PRIMARY KEY (id),
   CONSTRAINT foreign_key_ingredients_type_id FOREIGN KEY (type_id) REFERENCES ingredient_types(id)
);