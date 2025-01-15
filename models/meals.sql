CREATE TABLE IF NOT EXISTS Meals
(
   id							        INT			   NOT NULL,
   name							     VARCHAR(64)  NOT NULL,
   description					     TEXT		   NOT NULL,
   image						        VARCHAR(128) NOT NULL,
   nb_portions					     INT			   NOT NULL,
   nb_calories					     INT			   NOT NULL,
   preparation_duration_minutes INT		      NOT NULL,
   is_vegan						     BOOLEAN,
   is_sugar_free				     BOOLEAN,
   is_vegetarian				     BOOLEAN,
   is_dairy_free				     BOOLEAN,
   is_low_carb					     BOOLEAN,
   is_low_calorie				     BOOLEAN,
   is_low_sodium				     BOOLEAN,
   is_high_protein			     BOOLEAN,
   is_keto_friendly			     BOOLEAN,
   is_halal						     BOOLEAN,
   is_kosher					     BOOLEAN,
   is_organic					     BOOLEAN,
   CONSTRAINT PK_MEALS PRIMARY KEY (id)
);

CREATE INDEX IDX_MEALS_VEGAN         ON Meals(is_vegan);
CREATE INDEX IDX_MEALS_SUGAR_FREE    ON Meals(is_sugar_free);
CREATE INDEX IDX_MEALS_VEGETARIAN    ON Meals(is_vegetarian);
CREATE INDEX IDX_MEALS_DAIRY_FREE    ON Meals(is_dairy_free);
CREATE INDEX IDX_MEALS_LOW_CARB      ON Meals(is_low_carb);
CREATE INDEX IDX_MEALS_LOW_CALORIE   ON Meals(is_low_calorie);
CREATE INDEX IDX_MEALS_LOW_SODIUM    ON Meals(is_low_sodium);
CREATE INDEX IDX_MEALS_HIGH_PROTEIN  ON Meals(is_high_protein);
CREATE INDEX IDX_MEALS_KETO_FRIENDLY ON Meals(is_keto_friendly);
CREATE INDEX IDX_MEALS_HALAL		    ON Meals(is_halal);
CREATE INDEX IDX_MEALS_KOSHER        ON Meals(is_kosher);
CREATE INDEX IDX_MEALS_ORGANIC       ON Meals(is_organic);