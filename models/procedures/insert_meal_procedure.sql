DROP PROCEDURE IF EXISTS insert_meal;

DELIMITER //
CREATE PROCEDURE insert_meal
(
    IN  category_name_input                     VARCHAR(32),
    IN  meal_name_input                         VARCHAR(64),
    IN  image_name_input                        VARCHAR(64),
    IN  description_input                       TEXT,
    IN  nb_portions_input                       INT,
    IN  nb_calories_per_portion_input           INT,
    IN  preparation_duration_minutes_input      INT,
    IN  is_halal_input                          BOOLEAN,
    IN  is_organic_input                        BOOLEAN,
    IN  is_vegan_input                          BOOLEAN,
    IN  is_vegetarian_input                     BOOLEAN,
    IN  is_sugar_free_input                     BOOLEAN,
    IN  is_dairy_free_input                     BOOLEAN,
    IN  is_low_carb_input                       BOOLEAN,
    IN  is_low_calorie_input                    BOOLEAN,
    IN  is_low_sodium_input                     BOOLEAN,
    IN  is_high_protein_input                   BOOLEAN,
    IN  is_keto_friendly_input                  BOOLEAN
) 
BEGIN
    DECLARE exit handler for sqlexception 
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

    INSERT INTO dietary_filters(is_halal, is_organic, is_vegan, is_vegetarian, is_sugar_free, is_dairy_free,
                                is_low_carb, is_low_calorie, is_low_sodium, is_high_protein, is_keto_friendly)
    VALUES (is_halal_input, is_organic_input, is_vegan_input, is_vegetarian_input, is_sugar_free_input, is_dairy_free_input,
            is_low_carb_input, is_low_calorie_input, is_low_sodium_input, is_high_protein_input, is_keto_friendly_input);
    
    SET @filters_id = LAST_INSERT_ID();
    
    INSERT INTO meals
    VALUES (@filters_id, category_name_input, meal_name_input, image_name_input, description_input,
            nb_portions_input, nb_calories_per_portion_input, preparation_duration_minutes_input);

    COMMIT;
END; //
DELIMITER ;