CREATE TABLE IF NOT EXISTS meals
(
   meal_id							   INT			   NOT NULL    UNIQUE,
   category_name                 VARCHAR(32)    NOT NULL    UNIQUE,
   meal_name							VARCHAR(64)    NOT NULL,
   image_name						   VARCHAR(64)    NOT NULL    DEFAULT "default_meal_image.png",
   description					      TEXT		      NOT NULL,
   nb_portions					      INT			   NOT NULL,
   nb_calories_per_portion		   INT			   NOT NULL,
   preparation_duration_minutes  INT		      NOT NULL,

   CONSTRAINT primary_key_meals
   PRIMARY KEY (meal_id),

   CONSTRAINT foreign_key_meals_meal_id
   FOREIGN KEY (meal_id)
   REFERENCES dietary_filters(filters_id)
   ON DELETE CASCADE,

   CONSTRAINT foreign_key_meals_category_name
   FOREIGN KEY (category_name)
   REFERENCES meal_categories(category_name)
   ON DELETE CASCADE
);