DROP PROCEDURE IF EXISTS fetch_recipe_rows;

DELIMITER //
CREATE PROCEDURE fetch_recipe_rows(IN meal_id_input INT)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_recipes AS
        SELECT ingredient_name, quantity
        FROM recipes
        WHERE meal_id = meal_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_ingredients AS
        SELECT ing.*, tr.quantity
        FROM temp_recipes AS tr
        JOIN ingredients AS ing
            ON tr.ingredient_name = ing.ingredient_name;

    SELECT ti.*, mu.unit_name_plural
    FROM temp_ingredients AS ti
    JOIN measurement_units AS mu
        ON ti.unit_name_singular = mu.unit_name_singular;

    DROP TEMPORARY TABLE IF EXISTS temp_recipes;
    DROP TEMPORARY TABLE IF EXISTS temp_ingredients;
END; //
DELIMITER ;