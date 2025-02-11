DELIMITER //
CREATE PROCEDURE IF NOT EXISTS add_to_shopping_list(IN user_id_input INT, IN meal_id_input INT)
BEGIN
    DECLARE current_ingredient_name VARCHAR(32);
    DECLARE current_quantity INT;
    DECLARE done BOOLEAN DEFAULT FALSE;
    
    DECLARE recipes_cursor CURSOR FOR
        SELECT ingredient_name, quantity
        FROM recipes
        WHERE meal_id = meal_id_input;

    DECLARE CONTINUE HANDLER
    FOR NOT FOUND
    SET done = TRUE;

    OPEN recipes_cursor;

    for_each_recipe_loop : LOOP
        FETCH recipes_cursor
        INTO current_ingredient_name, current_quantity;

        IF done THEN
            LEAVE for_each_recipe_loop;
        END IF;
        
        IF is_ingredient_in_shopping_list(user_id_input, current_ingredient_name) THEN
            UPDATE shopping_lists
            SET quantity = quantity + current_quantity
            WHERE user_id = user_id_input
                AND ingredient_name = current_ingredient_name;
        ELSE
            INSERT INTO shopping_lists
            VALUES (user_id_input, current_ingredient_name, current_quantity);
        END IF;
    END LOOP;

    CLOSE recipes_cursor;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_shopping_list AS
        SELECT ingredient_name, quantity
        FROM shopping_lists
        WHERE user_id = user_id_input;

    CREATE TEMPORARY TABLE IF NOT EXISTS temp_user_shopping_list_ingredients AS
        SELECT ing.*, tusl.quantity
        FROM temp_user_shopping_list AS tusl
        JOIN ingredients AS ing
            ON tusl.ingredient_name = ing.ingredient_name;

    DROP TEMPORARY TABLE IF EXISTS temp_user_shopping_list;

    SELECT tusli.*, mu.unit_name_plural
    FROM temp_user_shopping_list_ingredients AS tusli
    JOIN measurement_units AS mu
        ON tusli.unit_name_singular = mu.unit_name_singular;

    DROP TEMPORARY TABLE IF EXISTS temp_user_shopping_list_ingredients;
END;
//
DELIMITER ;