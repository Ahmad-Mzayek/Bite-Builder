DELIMITER //
CREATE PROCEDURE fetch_recipe_rows(IN meal_id_input INT)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_recipes_view AS
        SELECT ingredient_name, quantity
        FROM recipes
        WHERE meal_id = meal_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_ingredients_view AS
        SELECT ing.*, rv.quantity
        FROM temp_recipes_view AS rv
        JOIN ingredients AS ing
            ON rv.ingredient_name = ing.ingredient_name;

    SELECT ingv.*, mu.unit_name_plural
    FROM temp_ingredients_view AS ingv
    JOIN measurement_units AS mu
        ON ingv.unit_name_singular = mu.unit_name_singular;

    DROP TEMPORARY TABLE IF EXISTS temp_recipes_view;
    DROP TEMPORARY TABLE IF EXISTS temp_ingredients_view;
END;
//
DELIMITER ;