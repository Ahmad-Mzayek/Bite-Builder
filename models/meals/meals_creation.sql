CREATE TABLE IF NOT EXISTS meals
(
   id							         INT			   NOT NULL    UNIQUE,
   category                      VARCHAR(32)    NOT NULL    UNIQUE,
   name							      VARCHAR(64)    NOT NULL,
   image_name						   VARCHAR(64)    NOT NULL    DEFAULT "default_meal_image.png",
   description					      TEXT		      NOT NULL,
   nb_portions					      INT			   NOT NULL,
   nb_calories_per_portion		   INT			   NOT NULL,
   preparation_duration_minutes  INT		      NOT NULL,

   CONSTRAINT primary_key_meals PRIMARY KEY (id),
   CONSTRAINT foreing_key_meals_id FOREIGN KEY (id) REFERENCES dietary_filters(id),
   CONSTRAINT foreign_key_meals_category FOREIGN KEY (category) REFERENCES meal_categories(name)
);