CREATE TABLE IF NOT EXISTS users_meal_categories
(
    user_id                 INT             NOT NULL,
    meal_category_name      VARCHAR(32)     NOT NULL,

    CONSTRAINT primary_key_users_meal_categories PRIMARY KEY (user_id, meal_category_name),
    CONSTRAINT foreign_key_user_meal_categories_user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT foreign_key_user_meal_categories_meal_category_name FOREIGN KEY (meal_category_name) REFERENCES meal_categories(category_name)
);