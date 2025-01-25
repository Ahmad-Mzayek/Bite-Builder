CREATE TABLE IF NOT EXISTS recipes
(
   meal_name         VARCHAR(64)   NOT NULL,
   ingredient_name   VARCHAR(32)   NOT NULL,
   quantity          INT,

   CONSTRAINT primary_key_recipes PRIMARY KEY (meal_name, ingredient_name),
   CONSTRAINT foreign_key_recipes_meal_name FOREIGN KEY (meal_name) REFERENCES meals(name),
   CONSTRAINT foreign_key_recipes_ingredient_name FOREIGN KEY (ingredient_name) REFERENCES ingredients(name)
);