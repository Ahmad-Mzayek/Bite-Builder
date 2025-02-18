DROP PROCEDURE IF EXISTS add_to_shopping_list;

DELIMITER //
CREATE PROCEDURE add_to_shopping_list(IN user_id_input INT, IN meal_id_input INT)
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

    DECLARE exit handler for sqlexception 
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

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

    COMMIT;
END; //
DELIMITER ;