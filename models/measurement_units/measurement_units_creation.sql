CREATE TABLE IF NOT EXISTS measurement_units
(
    name_singular   VARCHAR(16)     NOT NULL    UNIQUE,
    name_plural     VARCHAR(16)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_measurement_units PRIMARY KEY (name_singular)
);