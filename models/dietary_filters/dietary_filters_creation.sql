CREATE TABLE IF NOT EXISTS dietary_filters
(
    filters_id          INT         NOT NULL    AUTO_INCREMENT,
    is_halal		    BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_organic			BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_vegan			BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_vegetarian		BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_sugar_free		BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_dairy_free		BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_low_carb			BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_low_calorie		BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_low_sodium		BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_high_protein     BOOLEAN     NOT NULL    DEFAULT FALSE,
    is_keto_friendly	BOOLEAN     NOT NULL    DEFAULT FALSE,

    CONSTRAINT primary_key_dietary_filters
    PRIMARY KEY (filters_id)
);