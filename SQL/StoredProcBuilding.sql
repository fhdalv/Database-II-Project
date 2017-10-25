DROP PROCEDURE IF EXISTS buildingList;
DROP FUNCTION IF EXISTS deleteBuildingByID;
DROP FUNCTION IF EXISTS insertBuilding;

DELIMITER $$

CREATE FUNCTION insertBuilding (b_id INT, b_code VARCHAR(5), b_name VARCHAR(32), b_address VARCHAR(32), b_manager_id INT) RETURNS INT
BEGIN
	-- Declare and initialize variables
    DECLARE v_result INT;
    DECLARE v_pk_count INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;
	
	SET v_result = -1;
    SET v_pk_count = 0;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;
	
	   -- Check if the ID is already used
    SELECT COUNT(*) 
    INTO v_pk_count 
    FROM   building 
    WHERE id = b_id;
	
	 IF v_pk_count = 0 THEN
	 
		 -- Here when a PK does NOT exist
        SELECT COUNT(*) 
        INTO v_row_count_before
        FROM building;
		
		INSERT INTO building (id, code, name, address, manager_id) VALUE (b_id, b_code, b_name, b_address, b_manager_id);
		
		SELECT COUNT(*) 
        INTO v_row_count_after
        FROM building;
		
		 IF v_row_count_after - v_row_count_before = 1 THEN
            -- insert succeeded
            SET v_result = 1;
        ELSE
            -- insert failed
            SET v_result = 0;
        END IF;
        
    END IF;
	
    return v_result;
END $$

/*
 * Procedure for returning all rows in the person table
 */
CREATE PROCEDURE buildingList()
BEGIN
	SELECT b.MANAGER_ID , p.FIRST_NAME, p.LAST_NAME, p.DOB,
	s.SALARY, s.EMP_NUM, b.CODE, b.NAME, b.ADDRESS, b.ID, s.PERSON_ID
FROM BUILDING b, PERSON p, STAFF s
WHERE s.PERSON_ID = p.ID
AND b.MANAGER_ID = s.PERSON_ID
ORDER BY b.MANAGER_ID DESC;
END $$
	
CREATE FUNCTION deleteBuildingByID (b_id INT) RETURNS INT
BEGIN

    -- Declare and initialize variables
    DECLARE v_result INT;
    DECLARE v_fk_count INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_result = -1;
    SET v_fk_count = 0;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;
	
	SELECT COUNT(*) 
    INTO v_fk_count 
    FROM employee 
    WHERE building_id = b_id;
	
	IF v_fk_count = 0 THEN
    
        -- Here when a FK does NOT exist
        SELECT COUNT(*) 
        INTO v_row_count_before
        FROM building;
		
		 DELETE FROM building WHERE id = b_id;
		 
		SELECT COUNT(*) 
        INTO v_row_count_after
        FROM building;
 IF v_row_count_before - v_row_count_after != 0 THEN
            -- Delete succeeded
            SET v_result = 1;
        ELSE
            -- Delete failed
            SET v_result = 0;
        END IF;
    END IF;

  return v_result;
END $$

DELIMITER ;
