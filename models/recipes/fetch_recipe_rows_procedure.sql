DELIMITER //
CREATE PROCEDURE fetch_recipe_rows(IN meal_id_input INT)
BEGIN
    CREATE OR REPLACE VIEW recipes_view
    AS
        SELECT ingredient_name, quantity
        FROM recipes
        WHERE meal_id = meal_id_input;

    CREATE OR REPLACE VIEW ingredients_view
    AS
        SELECT ing.*, rv.quantity
        FROM recipes_view AS rv
        JOIN ingredients AS ing
            ON rv.ingredient_name = ing.ingredient_name;

    SELECT ingv.*, mu.unit_name_plural
    FROM ingredients_view AS ingv
    JOIN measurement_units AS mu
        ON ingv.unit_name_singular = mu.unit_name_singular;
END;
//
DELIMITER ;