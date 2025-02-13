DROP TRIGGER IF EXISTS after_meal_category_insert_trigger;

DELIMITER //
CREATE TRIGGER after_meal_category_insert_trigger
AFTER INSERT ON meal_categories
FOR EACH ROW
BEGIN
    DECLARE current_user_id INT;
    DECLARE done BOOLEAN DEFAULT FALSE;
    
    DECLARE users_cursor CURSOR FOR
        SELECT user_id
        FROM users;

    DECLARE CONTINUE HANDLER
    FOR NOT FOUND
    SET done = TRUE;

    OPEN users_cursor;

    for_each_user_loop: LOOP
        FETCH users_cursor
        INTO current_user_id;
        
        IF done THEN
            LEAVE for_each_user_loop;
        END IF;
        
        INSERT INTO users_meal_categories
        VALUES (current_user_id, NEW.category_name);
    END LOOP;

    CLOSE users_cursor;
END; //
DELIMITER ;