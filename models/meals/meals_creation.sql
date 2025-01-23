CREATE TABLE IF NOT EXISTS meals
(
   id							         INT			   NOT NULL    AUTO_INCREMENT,
   category_id                   INT            NOT NULL,
   name							      VARCHAR(64)    NOT NULL,
   image_name						   VARCHAR(64)    NOT NULL    DEFAULT "default_meal_image.png",
   description					      TEXT		      NOT NULL,
   nb_portions					      INT			   NOT NULL,
   nb_calories_per_portion		   INT			   NOT NULL,
   preparation_duration_minutes  INT		      NOT NULL,
   is_halal						      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_kosher					      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_organic					      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_vegan						      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_vegetarian				      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_sugar_free				      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_dairy_free				      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_low_carb					      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_low_calorie				      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_low_sodium				      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_high_protein			      BOOLEAN        NOT NULL    DEFAULT FALSE,
   is_keto_friendly			      BOOLEAN        NOT NULL    DEFAULT FALSE,

   CONSTRAINT primary_key_meals PRIMARY KEY (id),
   CONSTRAINT foreign_key_meals_category_id FOREIGN KEY (category_id) REFERENCES meal_categories(id)
);