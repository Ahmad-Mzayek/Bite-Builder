CREATE TABLE IF NOT EXISTS measurement_units
(
    id              INT             NOT NULL    AUTO_INCREMENT,
    name_singular   VARCHAR(16)     NOT NULL    UNIQUE,
    name_plural     VARCHAR(16)     NOT NULL    UNIQUE,

    CONSTRAINT primary_key_measurement_units PRIMARY KEY (id)
);