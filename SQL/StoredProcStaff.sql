DROP PROCEDURE IF EXISTS staffList;
DROP FUNCTION IF EXISTS deleteStaffByID;
DROP FUNCTION IF EXISTS insertStaff;

DELIMITER $$

CREATE FUNCTION insertStaff (s_person_id INT, s_emp_num VARCHAR(5), s_start_date DATE, s_end_date DATE, s_salary DOUBLE) RETURNS INT
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
    FROM   staff 
    WHERE person_id = s_person_id;
	
	 IF v_pk_count = 0 THEN
	 
		 -- Here when a PK does NOT exist
        SELECT COUNT(*) 
        INTO v_row_count_before
        FROM staff;
		
		INSERT INTO staff (person_id, emp_num, start_date, end_date, salary) VALUE (s_person_id, s_emp_num, s_start_date, s_end_date, s_salary);
		
		SELECT COUNT(*) 
        INTO v_row_count_after
        FROM staff;
		
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
CREATE PROCEDURE staffList()
BEGIN
	SELECT  s.PERSON_ID, p.FIRST_NAME, p.LAST_NAME, p.DOB, p.ADDRESS,
		s.SALARY, s.START_DATE, s.END_DATE, s.EMP_NUM
FROM PERSON p, STAFF s
WHERE s.PERSON_ID = p.ID
ORDER BY s.PERSON_ID DESC;
END $$
	
CREATE FUNCTION deleteStaffByID (s_person_id INT) RETURNS INT
BEGIN

    -- Declare and initialize variables
	DECLARE v_result INT;
    DECLARE v_fk_count INT;
	DECLARE v_fk_count2 INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_result = -1;
	SET v_fk_count = 0;
	SET v_fk_count2 = 0;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;
	
	SELECT COUNT(*) 
    INTO v_fk_count 
    FROM building 
    WHERE manager_id = s_person_id;
	
	SELECT COUNT(*) 
    INTO v_fk_count 
    FROM employee
    WHERE person_id = s_person_id;
	
	IF (v_fk_count = 0 && v_fk_count2= 0) THEN
    
        -- Here when a FK does NOT exist
        SELECT COUNT(*) 
        INTO v_row_count_before
        FROM staff;
		
		 DELETE FROM staff WHERE person_id = s_person_id;
		 
		SELECT COUNT(*) 
        INTO v_row_count_after
        FROM staff;
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

	