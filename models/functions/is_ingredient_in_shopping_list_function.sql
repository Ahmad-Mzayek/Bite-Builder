DELIMITER //

CREATE FUNCTION is_ingredient_in_shopping_list(user_id_input INT, ingredient_name_input VARCHAR(32))
RETURNS BOOLEAN
BEGIN
    DECLARE exists_count INT;
    
    SELECT COUNT(*) INTO exists_count
    FROM shopping_lists
    WHERE user_id = user_id_input
        AND ingredient_name = ingredient_name_input;
    
    RETURN exists_count > 0;
END;
//
DELIMITER ;