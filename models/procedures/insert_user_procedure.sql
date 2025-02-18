DROP PROCEDURE IF EXISTS insert_user;

DELIMITER //
CREATE PROCEDURE insert_user
(
    IN username_input           VARCHAR(32),
    IN email_address_input      VARCHAR(64),
    IN hashed_password_input    CHAR(64)
) 
BEGIN
    DECLARE exit handler for sqlexception 
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

    INSERT INTO dietary_filters
    VALUES ();
    
    SET @user_id = LAST_INSERT_ID();
    
    INSERT INTO users(user_id, username, email_address, hashed_password)
    VALUES (@user_id, username_input, email_address_input, hashed_password_input);

    COMMIT;
END; //
DELIMITER ;