DELIMITER //
CREATE PROCEDURE IF NOT EXISTS fetch_preferred_meal_ids
(
    IN  user_id_input                           INT,
    IN  min_nb_calories_per_portion_input       INT,
    IN  max_nb_calories_per_portion_input       INT,
    IN  min_preparation_duration_minutes_input  INT,
    IN  max_preparation_duration_minutes_input  INT,
    IN  is_favorites_checked_input              BOOLEAN,
    IN  searched_meal_name_input                VARCHAR(64),
    IN  sort_by_input                           VARCHAR(32),
    IN  order_input                             VARCHAR(8)
)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_categories AS
        SELECT category_name
        FROM users_meal_categories
        WHERE user_id = user_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_meals AS
        SELECT *
        FROM meals
        WHERE nb_calories_per_portion BETWEEN min_nb_calories_per_portion_input AND max_nb_calories_per_portion_input
            AND preparation_duration_minutes BETWEEN min_preparation_duration_minutes_input AND max_preparation_duration_minutes_input
            AND meal_name LIKE CONCAT(searched_meal_name_input, "%") COLLATE utf8mb4_general_ci;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_categorized_meals AS
        SELECT tm.*
        FROM temp_meals AS tm
        JOIN temp_user_categories AS tuc
            ON tm.category_name = tuc.category_name;

    DROP TEMPORARY TABLE IF EXISTS temp_meals;
    DROP TEMPORARY TABLE IF EXISTS temp_user_categories;

    IF is_favorites_checked_input = TRUE THEN
        CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_favorites AS
            SELECT meal_id
            FROM favorites
            WHERE user_id = user_id_input;

        CREATE TEMPORARY TABLE IF NOT EXISTS temp_final_meals AS
            SELECT tcm.*
            FROM temp_categorized_meals AS tcm
            JOIN temp_user_favorites AS tuf
                ON tcm.meal_id = tuf.meal_id;
        
        DROP TEMPORARY TABLE IF EXISTS temp_user_favorites;

    ELSE
        CREATE TEMPORARY TABLE IF NOT EXISTS temp_final_meals AS
            SELECT *
            FROM temp_categorized_meals;
    END IF;

    DROP TEMPORARY TABLE IF EXISTS temp_categorized_meals;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_meal_filters AS
        SELECT df.*
        FROM dietary_filters AS df
        JOIN temp_final_meals AS tfm
            ON tfm.meal_id = df.filters_id;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_filters AS
        SELECT *
        FROM dietary_filters
        WHERE filters_id = user_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_matching_meal_ids AS
        SELECT tmf.filters_id
        FROM temp_meal_filters AS tmf
        JOIN temp_user_filters AS tuf
            ON (tuf.is_halal = FALSE OR tmf.is_halal = tuf.is_halal)
            AND (tuf.is_organic = FALSE OR tmf.is_organic = tuf.is_organic)
            AND (tuf.is_vegan = FALSE OR tmf.is_vegan = tuf.is_vegan)
            AND (tuf.is_vegetarian = FALSE OR tmf.is_vegetarian = tuf.is_vegetarian)
            AND (tuf.is_sugar_free = FALSE OR tmf.is_sugar_free = tuf.is_sugar_free)
            AND (tuf.is_dairy_free = FALSE OR tmf.is_dairy_free = tuf.is_dairy_free)
            AND (tuf.is_low_carb = FALSE OR tmf.is_low_carb = tuf.is_low_carb)
            AND (tuf.is_low_calorie = FALSE OR tmf.is_low_calorie = tuf.is_low_calorie)
            AND (tuf.is_low_sodium = FALSE OR tmf.is_low_sodium = tuf.is_low_sodium)
            AND (tuf.is_high_protein = FALSE OR tmf.is_high_protein = tuf.is_high_protein)
            AND (tuf.is_keto_friendly = FALSE OR tmf.is_keto_friendly = tuf.is_keto_friendly);

    DROP TEMPORARY TABLE IF EXISTS temp_meal_filters;
    DROP TEMPORARY TABLE IF EXISTS temp_user_filters;

    SET @query = CONCAT(
        "SELECT tfm.meal_id
        FROM temp_final_meals AS tfm
        JOIN temp_matching_meal_ids AS tmmi
            ON tfm.meal_id = tmmi.filters_id
        ORDER BY ", sort_by_input, " ", order_input, ";"
    );

    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    DROP TEMPORARY TABLE IF EXISTS temp_final_meals;
    DROP TEMPORARY TABLE IF EXISTS temp_matching_meal_ids;
END;
//
DELIMITER ;