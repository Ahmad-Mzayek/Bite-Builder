/*==============================================================*/
/* Table: Meal_Ingredients                                      */
/*==============================================================*/
CREATE TABLE IF NOT EXISTS Meal_Ingredients
(
   meal_id       INT NOT NULL,
   ingredient_id INT NOT NULL,
   quantity      INT,
   CONSTRAINT PK_MEAL_INGREDIENTS             PRIMARY KEY (meal_id, ingredient_id),
   CONSTRAINT FK_MEAL_INGREDIENTS_MEALS       FOREIGN KEY (meal_id)                 REFERENCES Meals (id),
   CONSTRAINT FK_MEAL_INGREDIENTS_INGREDIENTS FOREIGN KEY (ingredient_id)           REFERENCES Ingredients (id)
);

CREATE INDEX IDX_MEAL_INGREDIENTS ON Meal_Ingredients (ingredient_id);