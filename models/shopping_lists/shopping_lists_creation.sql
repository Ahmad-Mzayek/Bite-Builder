CREATE TABLE IF NOT EXISTS shopping_lists
(
   user_id        INT   NOT NULL,
   ingredient_id  INT   NOT NULL,
   quantity       INT,

   CONSTRAINT primary_key_shopping_lists PRIMARY KEY (user_id, ingredient_id),
   CONSTRAINT foreign_key_shopping_lists_user_id FOREIGN KEY (user_id) REFERENCES users(id),
   CONSTRAINT foreign_key_shopping_lists_ingredient_id FOREIGN KEY (ingredient_id) REFERENCES ingredients(id)
);