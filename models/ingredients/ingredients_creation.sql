CREATE TABLE IF NOT EXISTS ingredients
(
   id                   INT            NOT NULL    AUTO_INCREMENT,
   type_id              INT            NOT NULL,
   measurement_unit_id  INT,
   name                 VARCHAR(32)    NOT NULL    UNIQUE,

   CONSTRAINT primary_key_ingredients PRIMARY KEY (id),
   CONSTRAINT foreign_key_ingredients_type_id FOREIGN KEY (type_id) REFERENCES ingredient_types(id),
   CONSTRAINT foreign_key_ingredients_measurement_unit_id FOREIGN KEY (measurement_unit_id) REFERENCES measurement_units(id)
);