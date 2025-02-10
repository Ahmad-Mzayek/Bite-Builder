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
    
    SET @filters_id = LAST_INSERT_ID();
    
    INSERT INTO users(user_id, username, email_address, hashed_password)
    VALUES (@filters_id, username_input, email_address_input, hashed_password_input);
END;
//
DELIMITER ;