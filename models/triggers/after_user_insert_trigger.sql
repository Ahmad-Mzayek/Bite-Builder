DROP TRIGGER IF EXISTS after_user_insert_trigger;

DELIMITER //
CREATE TRIGGER after_user_insert_trigger
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    DECLARE current_category_name VARCHAR(32);
    DECLARE done BOOLEAN DEFAULT FALSE;

    DECLARE meal_categories_cursor CURSOR FOR
        SELECT category_name
        FROM meal_categories;

    DECLARE CONTINUE HANDLER
    FOR NOT FOUND
    SET done = TRUE;

    OPEN meal_categories_cursor;

        for_each_category_loop: LOOP
            FETCH meal_categories_cursor
            INTO current_category_name;

            IF done THEN
                LEAVE for_each_category_loop;
            END IF;

            INSERT INTO users_meal_categories
            VALUES (NEW.user_id, current_category_name);
        END LOOP;

    CLOSE meal_categories_cursor;
END; //
DELIMITER ;