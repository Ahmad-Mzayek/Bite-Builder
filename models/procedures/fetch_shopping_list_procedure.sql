DELIMITER //
CREATE PROCEDURE IF NOT EXISTS fetch_shopping_list(IN user_id_input INT)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_shopping_list AS
        SELECT ingredient_name, quantity
        FROM shopping_lists
        WHERE user_id = user_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_ingredients AS
        SELECT ing.*, tsl.quantity
        FROM temp_shopping_list AS tsl
        JOIN ingredients AS ing
            ON tsl.ingredient_name = ing.ingredient_name;

    SELECT ti.*, mu.unit_name_plural
    FROM temp_ingredients AS ti
    JOIN measurement_units AS mu
        ON ti.unit_name_singular = mu.unit_name_singular;

    DROP TEMPORARY TABLE IF EXISTS temp_ingredients;
    DROP TEMPORARY TABLE IF EXISTS temp_shopping_list;
END;
//
DELIMITER ;
