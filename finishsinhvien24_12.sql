


# Sinh vien

-- Tạo view cho yêu cầu dữ liệu từ i3
Drop view if exists Question_Exam_View;
Create View Question_Exam_View as
	SELECT exam.EXAMID, exam.EXAMDATE, exam.SUBJECTID, exam.EXAMLENGTH, exam.TITLE, questionrepresentation.ID AS representid, 
    question.ID AS question_id, question.QUESTIONTEXT, answer.INDEX_ , answer.ANSWERTEXT, generaldescription.DESCRIPTIONTEXT,
    filedescription.FILE, filedescription.FILESOURCE
    FROM exam INNER JOIN use_ ON exam.EXAMID=use_.EXAMID AND exam.EXAMDATE=use_.EXAMDATE
			  INNER JOIN questionrepresentation ON use_.EXAMDATE=questionrepresentation.EXAMDATE
              INNER JOIN question ON questionrepresentation.QUESTIONID=question.ID
              INNER JOIN containb ON question.ID=containb.QUESTIONID
              INNER JOIN generaldescription ON containb.DESCONID=generaldescription.ID
              INNER JOIN answer ON question.ID=answer.QUESTIONID
              INNER JOIN descriptioncontent ON descriptioncontent.ID=generaldescription.DESCONID 
              OR descriptioncontent.ID=question.DESCCONTID 
              OR descriptioncontent.ID=answer.DESCONTID
              INNER JOIN has ON descriptioncontent.ID=has.DESCONID
              INNER JOIN filedescription ON has.FILEDESID=filedescription.ID;
-- XEM DE THI 
DROP PROCEDURE IF EXISTS xemDeThi1MonHoc;
DELIMITER //
-- 3.1. Xem các đề thi của một môn học cho 1 lần thi cụ thể trong 1 học kỳ, ở 1 năm học.
CREATE PROCEDURE xemDeThi1MonHoc(Subject_id	 INT,
                                 ExamTerm           INT,
							     AcademicStartYear  INT,
                                 AcademicEndYear    INT)
	Begin
		SELECT * FROM Question_Exam_View WHERE EXAMDATE IN (SELECT EXAMDATE FROM examtime WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear);
	end //
DELIMITER ;

-- HAM SO CAU HOI


-- VIEW CAU HOI
DROP VIEW if exists CAUHOI;
CREATE VIEW CAUHOI AS SELECT question.SUBJECTID, ID, TERM, STARTYEAR, ENDYEAR FROM question JOIN EXAMTIME;

#3.1

DROP PROCEDURE IF EXISTS LAMBAI;
DELIMITER $$
CREATE PROCEDURE LAMBAI(
CHOOSE INT,
ANSWERCONTENT_ID INT,
QUESTIONANSWER_ID INT,
STUDENT_ID INT, 
EXAM_ID INT
)
BEGIN 
	UPDATE CHOOSE
    SET ANSWERCHOOSE = CHOOSE 
    WHERE ANSWERCONTENTID =ANSWERCONTENT_ID AND QUESTIONANSWERID = QUESTIONANSWER_ID AND STUDENTID =STUDENT_ID AND EXAMID = EXAM_ID;
END $$
DELIMITER ;
-- 
-- # 3.3

 DROP PROCEDURE IF EXISTS XEMDAPAN;
 DELIMITER //
 CREATE PROCEDURE XEMDAPAN(EXAM_ID INT,
ExamTerm 	INT,
START_YEAR  INT,
END_YEAR    INT

 )
 	BEGIN
	 drop view if exists dapan;
     CREATE VIEW DAPAN AS 
     SELECT INDEX_,ANSWERTEXT, CORRECTNESS, DESCONTID, EXAM.EXAMID, TERM, STARTYEAR, ENDYEAR, EXAM.SUBJECTID FROM EXAM JOIN ANSWER JOIN EXAMTIME ON EXAM.SUBJECTID = EXAMTIME.SUBJECTID;
																						
     SELECT * FROM DAPAN 
     WHERE CORRECTNESS = TRUE AND EXAM_ID = EXAMID  AND EXAMTERM =  TERM AND START_YEAR = STARTYEAR AND END_YEAR = ENDYEAR;
     END//
DELIMITER ;
-- #3.4 xem lai bai lam
 
DROP PROCEDURE IF EXISTS XEMLAIBAILAM;
DELIMITER //
CREATE procedure XEMLAIBAILAM(
STUDENT_ID int,
EXAM_ID INT,
subject_id int,
EXAMTERM INT,
START_ INT,
END_ INT
)
	BEGIN
		DROP VIEW IF EXISTS XEMLAI;
        CREATE VIEW XEMLAI AS SELECT ANSWERCHOOSE, EXAMID, ANSWERCONTENTID, TERM, STARTYEAR, ENDYEAR, STUDENTID, subjectid FROM CHOOSE JOIN EXAMTIME;
		SELECT ANSWERCHOOSE, EXAMID, ANSWERCONTENTID, subjectid FROM XEMLAI
        WHERE STUDENT_ID = STUDENTID AND EXAM_ID = EXAMID AND EXAMTERM = TERM AND START_ = STARTYEAR AND END_ = ENDYEAR and subject_id =subjectid;
	END //
DELIMITER ;        


DROP Function IF EXISTS kiemTraCauTraLoiDung;
DELIMITER //
-- Kiem tra cau tra loi trong bai lam cua sinh vien co dung ko
CREATE Function kiemTraCauTraLoiDung(answercontent_id INT)
returns BOOL DETERMINISTIC
	Begin
        RETURN IF (NOT EXISTS (SELECT DISTINCT e1.ANSWERCHOOSE
                   FROM (SELECT ANSWERCHOOSE FROM choose WHERE ANSWERCONTENTID = answercontent_id)e1 LEFT JOIN (SELECT INDEX_ FROM answer WHERE QUESTIONID = (SELECT QUESTIONID FROM answercontent WHERE ID=answercontent_id LIMIT 0,1) AND CORRECTNESS=TRUE)e2 ON e1.ANSWERCHOOSE = e2.INDEX_
                   WHERE e2.INDEX_ IS NULL) AND NOT EXISTS(SELECT DISTINCT e1.INDEX_
                   FROM (SELECT INDEX_ FROM answer WHERE QUESTIONID = (SELECT QUESTIONID FROM answercontent WHERE ID=answercontent_id LIMIT 0,1) AND CORRECTNESS=TRUE)e1 LEFT JOIN (SELECT ANSWERCHOOSE FROM choose WHERE ANSWERCONTENTID = answercontent_id)e2 ON e1.INDEX_ = e2.ANSWERCHOOSE
                   WHERE e2.ANSWERCHOOSE IS NULL), TRUE, FALSE);
	end //
DELIMITER ;

DROP FUNCTION IF EXISTS tinhDiemSinhVien;
DELIMITER //

CREATE FUNCTION tinhDiemSinhVien(student_id         INT, 
								 Subject_id	     INT,
								 ExamTerm           INT,
								 AcademicStartYear  INT,
								 AcademicEndYear    INT)
returns DECIMAL(4,2) DETERMINISTIC
    Begin
        DECLARE res DECIMAL(4,2);
        DECLARE n INT DEFAULT 0;
		DECLARE i INT DEFAULT 0;
        DECLARE count INT DEFAULT 0;
        DECLARE temp  INT DEFAULT 0;
        SELECT COUNT(*) FROM answercontent WHERE questionanswerid = (SELECT ID FROM questionanswer WHERE STUDENTID=student_id 
		AND EXAMID=(SELECT EXAMID FROM exam 
		WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
		WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear LIMIT 1) LIMIT 1) LIMIT 1) INTO n;
	    
        SET i=0;
        SET count=0;
        SET temp=0;
        WHILE i<n DO
          SET temp = (SELECT ID FROM answercontent 
                                    WHERE questionanswerid = (SELECT ID FROM questionanswer WHERE STUDENTID=student_id
                                    AND EXAMID=(SELECT EXAMID FROM exam 
		                            WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
		                            WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear LIMIT 1) LIMIT 1) LIMIT 1) LIMIT i,1);
		  
                                    
		  IF ((kiemTraCauTraLoiDung(temp))=1) THEN
		    SET count = count + 1;
          END IF;
          SET i = i + 1;
		END WHILE;
        
        SET res = CAST((CAST(count*10 AS DECIMAL) / CAST(n AS DECIMAL))AS DECIMAL(4,2));
        RETURN res;
	
	end //                                       

DELIMITER ;

DROP PROCEDURE IF EXISTS XEMDIEM;
DELIMITER //
CREATE PROCEDURE XEMDIEM(
STUDENT_ID INT,
subject_id int,
TERM_ INT,
START_YEAR INT,
END_YEAR INT
)
	begin
		declare insdiem decimal(4,2) default 0;
		set insdiem = tinhDiemSinhVien(student_id,subject_id,term_,start_year,end_year);
        insert diem value(student_id, subject_id, insdiem);
        select * from diem where studentid =student_id and subjectid =subject_id;
    end //
DELIMITER ;


# 3.6
DROP procedure IF exists XEMDIEMCACMON;
DELIMITER //
CREATE PROCEDURE XEMDIEMCACMON(
STUDENT_ID int
)
	BEGIN
		SELECT * FROM DIEM where studentid = student_id;
    END //
DELIMITER ;
#3.8
DROP PROCEDURE IF EXISTS GHICHU;
DELIMITER //
CREATE PROCEDURE GHICHU(
NOTE_ VARCHAR(255),
EXAM_ID INT
)
BEGIN
	 UPDATE exam
     SET NOTE=NOTE_ WHERE EXAMID = EXAM_ID;
END //
DELIMITER ;

GRANT EXECUTE ON PROCEDURE assignment.ghichu to 'student'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.ghichu to 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemdapan to 'student' @'localhost';
GRANT EXECUTE ON PROCEDURE assignment.lambai to 'student'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDeThi1MonHoc to 'student'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDiemCACMON to 'student'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemdiem to 'student' @'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemlaibailam to 'student'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.tinhDiemSinhVien to 'student'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.kiemTraCauTraLoiDung to 'student'@'localhost';



-- use assignment;
call xemdiem(1,2007,1,2020,2021);
call xemdiemcacmon(1);
CALL XEMLAIBAILAM(1,1,2005,1,2020,2021); 
CALL XEMDETHI1MONHOC(2005,1,2020,2021);
CALL XEMDAPAN(1,1,2020,2021);
call ghichu("bai 6 sai roi ", 1);

 
