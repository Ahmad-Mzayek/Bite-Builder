CREATE TABLE IF NOT EMPTY meal_categories
(
    id      INT             NOT NULL    AUTO_INCREMENT,
    name    VARCHAR(32)     NOT NULL,

    CONSTRAINT primary_key_meal_categories PRIMARY KEY (id)
);