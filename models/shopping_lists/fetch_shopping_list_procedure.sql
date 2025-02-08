DELIMITER //
CREATE PROCEDURE fetch_shopping_list(IN user_id_input INT)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_shopping_list_view AS
        SELECT ingredient_name, quantity
        FROM shopping_lists
        WHERE user_id = user_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_ingredients_view AS
        SELECT ing.*, slv.quantity
        FROM temp_shopping_list_view AS slv
        JOIN ingredients AS ing
            ON slv.ingredient_name = ing.ingredient_name;

    SELECT ingv.*, mu.unit_name_plural
    FROM temp_ingredients_view AS ingv
    JOIN measurement_units AS mu
        ON ingv.unit_name_singular = mu.unit_name_singular;

    DROP TEMPORARY TABLE IF EXISTS temp_shopping_list_view;
    DROP TEMPORARY TABLE IF EXISTS temp_ingredients_view;
END;
//
DELIMITER ;
