DELIMITER //
CREATE PROCEDURE fetch_shopping_list(IN user_id_input INT)
BEGIN
    CREATE OR REPLACE VIEW shopping_list_view
    AS
        SELECT ingredient_name, quantity
        FROM shopping_lists
        WHERE user_id = user_id_input;

    CREATE OR REPLACE VIEW ingredients_view
    AS
        SELECT ing.*, slv.quantity
        FROM shopping_list_view AS slv
        JOIN ingredients AS ing
            ON slv.ingredient_name = ing.ingredient_name;

    SELECT ingv.*, mu.unit_name_plural
    FROM ingredients_view AS ingv
    JOIN measurement_units AS mu
        ON ingv.unit_name_singular = mu.unit_name_singular;
END;
//
DELIMITER ;