CREATE TABLE IF NOT EXISTS favorites
(
   user_id  INT   NOT NULL,
   meal_id  INT   NOT NULL,

   CONSTRAINT primary_key_favorites PRIMARY KEY (user_id, meal_id),
   CONSTRAINT foreign_key_favorites_user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
   CONSTRAINT foreign_key_favorites_meal_id FOREIGN KEY (meal_id) REFERENCES meals(meal_id)
);