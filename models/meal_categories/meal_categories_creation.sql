CREATE TABLE IF NOT EXISTS meal_categories
(
    category_name    VARCHAR(32)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_meal_categories
    PRIMARY KEY (category_name)
);