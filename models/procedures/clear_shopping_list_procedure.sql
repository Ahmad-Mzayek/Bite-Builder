DROP PROCEDURE IF EXISTS clear_shopping_list;

DELIMITER //
CREATE PROCEDURE clear_shopping_list(IN user_id_input INT)
BEGIN
    DELETE FROM shopping_lists
    WHERE user_id = user_id_input;
END; //
DELIMITER ;