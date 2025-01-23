CREATE TABLE IF NOT EXISTS meal_ingredients
(
   meal_id           INT   NOT NULL,
   ingredient_id     INT   NOT NULL,
   quantity          INT,

   CONSTRAINT primary_key_meal_ingredients PRIMARY KEY (meal_id, ingredient_id),
   CONSTRAINT foreign_key_meal_ingredients_meal_id FOREIGN KEY (meal_id) REFERENCES meals(id),
   CONSTRAINT foreign_key_meal_ingredients_ingredient_id FOREIGN KEY (ingredient_id) REFERENCES ingredients(id)
);