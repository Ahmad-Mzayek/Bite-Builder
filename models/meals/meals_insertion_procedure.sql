DELIMITER //
CREATE PROCEDURE insert_meal
(
    IN category_name                    VARCHAR(32),
    IN meal_name                        VARCHAR(64),
    IN image_name                       VARCHAR(64),
    IN description                      TEXT,
    IN nb_portions                      INT,
    IN nb_calories_per_portion          INT,
    IN preparation_duration_minutes     INT,
    IN is_halal                         BOOLEAN,
    IN is_organic                       BOOLEAN,
    IN is_vegan                         BOOLEAN,
    IN is_vegetarian                    BOOLEAN,
    IN is_sugar_free                    BOOLEAN,
    IN is_dairy_free                    BOOLEAN,
    IN is_low_carb                      BOOLEAN,
    IN is_low_calorie                   BOOLEAN,
    IN is_low_sodium                    BOOLEAN,
    IN is_high_protein                  BOOLEAN,
    IN is_keto_friendly                 BOOLEAN
) 
BEGIN
    INSERT INTO dietary_filters(is_halal, is_organic, is_vegan, is_vegetarian, is_sugar_free, is_dairy_free,
                                is_low_carb, is_low_calorie, is_low_sodium, is_high_protein, is_keto_friendly)
    VALUES (is_halal, is_organic, is_vegan, is_vegetarian, is_sugar_free, is_dairy_free,
            is_low_carb, is_low_calorie, is_low_sodium, is_high_protein, is_keto_friendly);
    
    SET @filters_id = LAST_INSERT_ID();
    
    INSERT INTO meals(meal_id, category_name, meal_name, image_name, description, nb_portions, nb_calories_per_portion, preparation_duration_minutes)
    VALUES (@filters_id, category_name, meal_name, image_name, description, nb_portions, nb_calories_per_portion, preparation_duration_minutes);
END;
//
DELIMITER ;