DELIMITER //
CREATE PROCEDURE insert_user
(
    IN username         VARCHAR(32),
    IN email_address    VARCHAR(64),
    IN hashed_password  CHAR(64)
) 
BEGIN
    INSERT INTO dietary_filters
    VALUES ();
    
    SET @filters_id = LAST_INSERT_ID();
    
    INSERT INTO users(user_id, username, email_address, hashed_password)
    VALUES (@filters_id, username, email_address, hashed_password);
END;
//
DELIMITER ;