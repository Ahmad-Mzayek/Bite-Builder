CREATE TABLE IF NOT EXISTS shopping_lists
(
   user_id           INT            NOT NULL,
   ingredient_name   VARCHAR(32)    NOT NULL,
   quantity          INT,

   CONSTRAINT primary_key_shopping_lists
   PRIMARY KEY (user_id, ingredient_name),

   CONSTRAINT foreign_key_shopping_lists_user_id
   FOREIGN KEY (user_id)
   REFERENCES users(user_id)
   ON DELETE CASCADE,

   CONSTRAINT foreign_key_shopping_lists_ingredient_name
   FOREIGN KEY (ingredient_name)
   REFERENCES ingredients(ingredient_name)
   ON DELETE CASCADE
);