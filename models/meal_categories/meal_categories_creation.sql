CREATE TABLE IF NOT EXISTS meal_categories
(
    name    VARCHAR(32)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_meal_categories PRIMARY KEY (meal_categories)
);