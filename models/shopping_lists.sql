/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/01/2025 8:12:30 PM                        */
/*==============================================================*/


/*==============================================================*/
/* Table: Shopping_Lists                                        */
/*==============================================================*/
CREATE TABLE IF NOT EXISTS Shopping_Lists
(
   user_id       INT NOT NULL,
   ingredient_id INT NOT NULL,
   quantity      INT NOT NULL,
   CONSTRAINT PK_SHOPPING_LISTS				  PRIMARY KEY (user_id, ingredient_id),
   CONSTRAINT FK_SHOPPING_LISTS_USERS		  FOREIGN KEY (user_id)	      REFERENCES Users (id),
   CONSTRAINT FK_SHOPPING_LISTS_INGREDIENTS FOREIGN KEY (ingredient_id) REFERENCES Ingredients (id)
);

CREATE INDEX IDX_SHOPPING_LISTS_INGREDIENT_ID ON Shopping_Lists (ingredient_id);

