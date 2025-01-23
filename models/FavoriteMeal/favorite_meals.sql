CREATE TABLE IF NOT EXISTS favorite_meals
(
   user_id     INT   NOT NULL,
   meal_id     INT   NOT NULL,

   CONSTRAINT primary_key_favorite_meals PRIMARY KEY (user_id, meal_id),
   CONSTRAINT foreign_key_favorite_meals_user_id FOREIGN KEY (user_id) REFERENCES users(id),
   CONSTRAINT foreign_key_favorite_meals_meal_id FOREIGN KEY (meal_id) REFERENCES meals(id)
);