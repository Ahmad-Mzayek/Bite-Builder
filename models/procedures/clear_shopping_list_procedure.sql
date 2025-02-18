DROP PROCEDURE IF EXISTS clear_shopping_list;

DELIMITER //
CREATE PROCEDURE clear_shopping_list(IN user_id_input INT)
BEGIN
    DECLARE exit handler for sqlexception 
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

    DELETE FROM shopping_lists
    WHERE user_id = user_id_input;

    COMMIT;
END; //
DELIMITER ;