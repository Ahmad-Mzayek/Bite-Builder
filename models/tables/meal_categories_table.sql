DROP TABLE IF EXISTS meal_categories;

CREATE TABLE meal_categories
(
    category_name    VARCHAR(32)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_meal_categories
    PRIMARY KEY (category_name)
);