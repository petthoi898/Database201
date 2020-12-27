-- CREATE TABLE
create database assignment;
USE ASSIGNMENT;
CREATE TABLE EMPLOYEE(
SSN CHAR(255),
FNAME CHAR(255),
MNAME CHAR(255),
LNAME CHAR(255),
BIRTHDAY DATE,
GENDER CHAR,
EMAIL CHAR(255),
PHONENUMBER CHAR(255),
EXPERIENCE INT(11),
IDPASSWORD CHAR(255),
PASSWORD CHAR(255),
ADDRESS VARCHAR(255),
SPECIFICATION CHAR(255),
PRIMARY KEY(SSN)
);

CREATE TABLE SUBJECTMANAGEMENTTEACHER (
SUBSSN CHAR(255),
primary key (SUBSSN),
foreign key(SUBSSN) references EMPLOYEE(SSN)
);

CREATE TABLE INCHARGETEACHER(
INCSSN CHAR(255),
primary key(INCSSN),
foreign key(INCSSN) references EMPLOYEE(SSN)
);
CREATE TABLE SUBJECT(
SUBJECTID INT(11),
SUBJECTNAME CHAR(255),
SUBSSN CHAR(255) NOT NULL,
primary key(SUBJECTID),
foreign key(SUBSSN) references SUBJECTMANAGEMENTTEACHER(SUBSSN)
);

CREATE TABLE DESCRIPTIONCONTENT(
ID INT(11),
primary key(ID)
);

CREATE TABLE STANDARD(
CONTENT CHAR(255),
SUBJECTID INT(11),
primary key(CONTENT,SUBJECTID),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID)
);


CREATE TABLE QUESTION(
ID INT(11) auto_increment,
QUESTIONTEXT CHAR(255),
CONTENT CHAR(255) NOT NULL,
SUBJECTID INT(11) NOT NULL,
INCSSN CHAR(255) NOT NULL,
DATEUPLOAD DATE,
DESCCONTID  INT(11),
primary key(ID),
foreign key(CONTENT, SUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN),
foreign key(DESCCONTID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE FILEDESCRIPTION(
ID INT(11),
FILESOURCE CHAR(255),
FILE CHAR(255),
primary key(ID)
);

CREATE TABLE GENERALDESCRIPTION(
ID       INT(11),
DESCONID INT(11),
DESCRIPTIONTEXT CHAR(255),
primary key(ID),
foreign key(DESCONID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE STUDENT(
ID INT(11),
FNAME CHAR(255),
MNAME CHAR(255),
LNAME CHAR(255),
GENDER CHAR,
BIRTHDAY DATE,
PHONENUMBER CHAR(255),
EMAIL CHAR(255),
IDPASSWORD CHAR(255),
PASSWORD CHAR(255),
ADDRESS VARCHAR(255),
primary key(ID)
);

CREATE TABLE EXAMTIME(
EXAMDATE DATE,
SUBJECTID INT(11),
STARTYEAR INT(11),
ENDYEAR INT(11),
TERM    INT(11),
NUMS_EXAM INT(11),
CHECK (NUMS_EXAM>1),
primary key(EXAMDATE,SUBJECTID),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID)
);

CREATE TABLE EXAM(
EXAMID INT(11) ,
EXAMDATE DATE,
SUBJECTID INT(11),
NOTE CHAR(255),
EXAMLENGTH INT(11),
TITLE CHAR(255),
INCSSN CHAR(255) NOT NULL,
CONFIRMDATE DATE,
APPROVALDATE DATE,
SUBSSN CHAR(255) NOT NULL,
CHECK (CONFIRMDATE <= APPROVALDATE AND APPROVALDATE <= EXAMDATE - 3),
primary key(EXAMID,EXAMDATE,SUBJECTID),
foreign key(EXAMDATE, SUBJECTID) references EXAMTIME(EXAMDATE, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN),
foreign key(SUBSSN) references SUBJECTMANAGEMENTTEACHER(SUBSSN)
);

CREATE TABLE ANSWER(
INDEX_ INT(11),
QUESTIONID INT(11),
ANSWERTEXT CHAR(255),
CORRECTNESS BOOL,
DESCONTID  INT(11),
CHECK (INDEX_>0 AND INDEX_<6),
primary key(INDEX_,QUESTIONID),
foreign key(QUESTIONID) references QUESTION(ID),
foreign key(DESCONTID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE QUESTIONREPRESENTATION(
ID INT(11),
QUESTIONID INT(11),
EXAMDATE DATE,
primary key(ID, QUESTIONID, EXAMDATE),
foreign key (QUESTIONID) references QUESTION(ID),
foreign key(EXAMDATE) references EXAMTIME(EXAMDATE)
);

CREATE TABLE QUESTIONANSWER(
ID INT(11),
STUDENTID INT(11),
EXAMID INT(11),
DATEANDTIME DATETIME,
primary key(ID, STUDENTID, EXAMID),
foreign key(STUDENTID) references STUDENT(ID),
foreign key(EXAMID) references EXAM(EXAMID)
);

CREATE TABLE ANSWERCONTENT(
ID INT(11),
QUESTIONANSWERID INT(11),
STUDENTID INT(11),
EXAMID INT(11),
QUESTIONID INT(11),
primary key(ID,QUESTIONANSWERID,STUDENTID,EXAMID),
foreign key( QUESTIONANSWERID, STUDENTID, EXAMID) references QUESTIONANSWER(ID, STUDENTID, EXAMID),
foreign key(QUESTIONID) references QUESTION(ID)
);
CREATE TABLE MAKE(
EXAMID INT(11),
INCSSN CHAR(255),
primary key(EXAMID),
foreign key (INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE USE_(
ID INT(11) auto_increment,
QUESTIONID INT(11),
EXAMDATE DATE,
EXAMID INT(11),
primary key(ID,QUESTIONID,EXAMDATE),
foreign key(ID, QUESTIONID, EXAMDATE) references QUESTIONREPRESENTATION(ID, QUESTIONID, EXAMDATE)
);

CREATE TABLE CONTAINA(
SUBSTANDARDCONTENT CHAR(255),
SUBSTANDARDSUBJECTID INT(11),
MAINSTANDARDCONTENT CHAR(255),
MAINSTANDARDSUBJECTID INT(11),
primary key(SUBSTANDARDCONTENT, SUBSTANDARDSUBJECTID),
foreign key(SUBSTANDARDCONTENT, SUBSTANDARDSUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(MAINSTANDARDCONTENT, MAINSTANDARDSUBJECTID) references STANDARD(CONTENT, SUBJECTID)
);

CREATE TABLE UPDATE_(
CONTENT CHAR(255),
SUBJECTID INT(11),
INCSSN CHAR(255),
primary key(CONTENT, SUBJECTID, INCSSN),
foreign key(CONTENT, SUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE TEACH(
SUBJECTID INT(11),
INCSSN CHAR(255),
primary key(SUBJECTID, INCSSN),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE CONTAINB(
DESCONID INT(11),
QUESTIONID INT(11),
primary key(DESCONID, QUESTIONID),
foreign key(DESCONID) references GENERALDESCRIPTION(ID),
foreign key(QUESTIONID) references QUESTION(ID)
);

CREATE TABLE HAS(
FILEDESID INT(11),
DESCONID INT(11),
primary key(FILEDESID, DESCONID),
foreign key(FILEDESID) references FILEDESCRIPTION(ID),
foreign key(DESCONID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE TAKENOTE(
STUDENTID INT(11),
EXAMID INT(11),
NOTE CHAR(255),
DATEANDTIME DATETIME,
primary key(STUDENTID, EXAMID),
foreign key(STUDENTID) references STUDENT(ID),
foreign key(EXAMID) references EXAM(EXAMID)
);
CREATE TABLE CHOOSE(
ANSWERCHOOSE INT(11),
ANSWERCONTENTID INT(11),
QUESTIONANSWERID INT(11),
STUDENTID INT(11),
EXAMID INT(11),
primary key(ANSWERCHOOSE, ANSWERCONTENTID, QUESTIONANSWERID, STUDENTID,EXAMID),
foreign key(ANSWERCONTENTID, QUESTIONANSWERID, STUDENTID, EXAMID) references ANSWERCONTENT(ID, QUESTIONANSWERID,STUDENTID,EXAMID)
);

 CREATE TABLE DIEM(
 STUDENTID INT(11),
 subjectid INT(11),
 DIEM DECIMAL(4,2)
 );



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

 
