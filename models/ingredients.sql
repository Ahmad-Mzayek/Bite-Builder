/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/01/2025 8:12:30 PM                        */
/*==============================================================*/


/*==============================================================*/
/* Table: Ingredients                                           */
/*==============================================================*/
CREATE TABLE IF NOT EXISTS Ingredients
(
   id   INT         NOT NULL,
   type VARCHAR(32) NOT NULL,
   name INT         NOT NULL,
   unit VARCHAR(16) NOT NULL,
   CONSTRAINT PK_INGREDIENTS                  PRIMARY KEY (id),
   CONSTRAINT FK_INGREDIENTS_INGREDIENT_TYPES FOREIGN KEY (type) REFERENCES Ingredient_Types (type)
);

CREATE INDEX IDX_INGREDIENTS_TYPE ON Ingredients (type);

