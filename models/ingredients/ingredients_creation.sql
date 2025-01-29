CREATE TABLE IF NOT EXISTS ingredients
(
   ingredient_name         VARCHAR(32)    NOT NULL    UNIQUE,
   type_name               VARCHAR(32)    NOT NULL,
   measurement_unit_name   VARCHAR(32),

   CONSTRAINT primary_key_ingredients PRIMARY KEY (ingredient_name),
   CONSTRAINT foreign_key_ingredients_type_name FOREIGN KEY (type_name) REFERENCES ingredient_types(type_name),
   CONSTRAINT foreign_key_ingredients_measurement_unit_name FOREIGN KEY (measurement_unit_name) REFERENCES measurement_units(unit_name_singular)
);