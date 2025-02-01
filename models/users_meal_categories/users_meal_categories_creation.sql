CREATE TABLE IF NOT EXISTS users_meal_categories
(
    user_id                 INT             NOT NULL,
    category_name           VARCHAR(32)     NOT NULL,

    CONSTRAINT primary_key_users_meal_categories PRIMARY KEY (user_id, category_name),
    CONSTRAINT foreign_key_users_meal_categories_user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT foreign_key_users_meal_categories_category_name FOREIGN KEY (category_name) REFERENCES meal_categories(category_name)
);