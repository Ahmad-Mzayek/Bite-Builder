DROP TABLE IF EXISTS measurement_units;

CREATE TABLE measurement_units
(
    unit_name_singular   VARCHAR(32)     NOT NULL    UNIQUE,
    unit_name_plural     VARCHAR(32)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_measurement_units
    PRIMARY KEY (unit_name_singular)
);