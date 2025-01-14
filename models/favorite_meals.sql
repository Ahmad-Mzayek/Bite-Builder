/*==============================================================*/
/* Table: Favorite_Meals                                        */
/*==============================================================*/
CREATE TABLE IF NOT EXISTS Favorite_Meals
(
   user_id INT NOT NULL,
   meal_id INT NOT NULL,
   CONSTRAINT PK_FAVORITE_MEALS		  PRIMARY KEY (user_id, meal_id),
   CONSTRAINT FK_FAVORITE_MEALS_USERS FOREIGN KEY (user_id) REFERENCES Users (id),
   CONSTRAINT FK_FAVORITE_MEALS_MEALS FOREIGN KEY (meal_id) REFERENCES Meals (id)
);

CREATE INDEX IDX_FAVORITE_MEALS_MEAL_ID ON Favorite_Meals (meal_id);