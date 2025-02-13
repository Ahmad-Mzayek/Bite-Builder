DROP PROCEDURE IF EXISTS fetch_user_meal_categories;

DELIMITER //
CREATE PROCEDURE fetch_user_meal_categories(IN user_id_input INT)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_categories AS
        SELECT category_name
        FROM users_meal_categories
        WHERE user_id = user_id_input;

    SELECT mc.category_name,
        CASE
            WHEN tuc.category_name IS NOT NULL THEN TRUE
            ELSE FALSE
        END AS is_selected
    FROM meal_categories AS mc
    LEFT JOIN temp_user_categories AS tuc
    ON mc.category_name = tuc.category_name;

    DROP TEMPORARY TABLE IF EXISTS temp_user_categories;
END; //
DELIMITER ;