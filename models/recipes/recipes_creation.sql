CREATE TABLE IF NOT EXISTS recipes
(
   meal_id           INT           NOT NULL,
   ingredient_name   VARCHAR(32)   NOT NULL,
   quantity          INT,

   CONSTRAINT primary_key_recipes PRIMARY KEY (meal_name, ingredient_name),
   CONSTRAINT foreign_key_recipes_meal_id FOREIGN KEY (meal_id) REFERENCES meals(id),
   CONSTRAINT foreign_key_recipes_ingredient_name FOREIGN KEY (ingredient_name) REFERENCES ingredients(name)
);