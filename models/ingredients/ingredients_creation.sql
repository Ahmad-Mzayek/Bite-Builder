CREATE TABLE IF NOT EXISTS ingredients
(
   name                 VARCHAR(32)    NOT NULL    UNIQUE,
   type                 VARCHAR(32)    NOT NULL,
   measurement_unit     VARCHAR(32),

   CONSTRAINT primary_key_ingredients PRIMARY KEY (name),
   CONSTRAINT foreign_key_ingredients_type FOREIGN KEY (type) REFERENCES ingredient_types(name),
   CONSTRAINT foreign_key_ingredients_measurement_unit FOREIGN KEY (measurement_unit) REFERENCES measurement_units(name_singular)
);