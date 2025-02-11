DELIMITER //
CREATE PROCEDURE IF NOT EXISTS insert_user
(
    IN username_input           VARCHAR(32),
    IN email_address_input      VARCHAR(64),
    IN hashed_password_input    CHAR(64)
) 
BEGIN
    INSERT INTO dietary_filters
    VALUES ();
    
    SET @user_id = LAST_INSERT_ID();
    
    INSERT INTO users(user_id, username, email_address, hashed_password)
    VALUES (@user_id, username_input, email_address_input, hashed_password_input);

    DECLARE done BOOLEAN DEFAULT FALSE;

    DECLARE current_category_name VARCHAR(32);

    DECLARE meal_categories_cursor CURSOR FOR
        SELECT category_name
        FROM meal_categories;

    DECLARE CONTINUE HANDLER
    FOR NOT FOUND
    SET done = TRUE;
    
    OPEN meal_categories_cursor;

    for_each_meal_category_loop: LOOP
        FETCH meal_categories_cursor
        INTO current_category_name;

        IF done THEN
            LEAVE for_each_meal_category_loop;
        END IF;

        INSERT INTO users_meal_categories
        VALUES (@user_id, current_category_name);
    END LOOP;

    CLOSE meal_categories_cursor;
END;
//
DELIMITER ;