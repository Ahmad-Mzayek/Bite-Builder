CREATE TABLE IF NOT EXISTS measurement_units
(
    name_singular   VARCHAR(32)     NOT NULL    UNIQUE,
    name_plural     VARCHAR(32)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_measurement_units PRIMARY KEY (name_singular)
);