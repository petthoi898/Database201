-- CREATE USER ROLE
DROP USER IF EXISTS 'incharge'@'localhost','subject_management'@'localhost','student'@'localhost','admin'@'localhost';
CREATE USER 'incharge'@'localhost','subject_management'@'localhost','student'@'localhost','admin'@'localhost';

# incharge teacher
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.question TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.generaldescription TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.answer TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.descriptioncontent TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.filedescription TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.containb TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.has TO 'incharge'@'localhost';

GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.exam TO 'incharge'@'localhost';
GRANT SELECT ON assignment.examtime TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.questionrepresentation TO 'incharge'@'localhost';
GRANT SELECT ON assignment.student TO 'incharge'@'localhost';
GRANT SELECT ON assignment.questionanswer TO 'incharge'@'localhost';
GRANT SELECT ON assignment.answercontent TO 'incharge'@'localhost';
GRANT SELECT ON assignment.choose TO 'incharge'@'localhost';
GRANT SELECT ON assignment.standard TO 'incharge'@'localhost';
GRANT SELECT ON assignment.containa TO 'incharge'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.use_ TO 'incharge'@'localhost';
GRANT SELECT ON assignment.takenote TO 'incharge'@'localhost';

# subject_management_teacher
GRANT SELECT ON assignment.question TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.generaldescription TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.descriptioncontent TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.filedescription TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.containb TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.has TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.subject TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.examtime TO 'subject_management'@'localhost';
GRANT SELECT,INSERT, UPDATE, DELETE ON assignment.exam TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.questionanswer TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.answercontent TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.choose TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.standard TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.containa TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.question TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.answer TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.questionrepresentation TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.use_ TO 'subject_management'@'localhost';
GRANT SELECT ON assignment.takenote TO 'subject_management'@'localhost';

# student
GRANT SELECT ON assignment.examtime TO 'student'@'localhost';
GRANT SELECT ON assignment.exam TO 'student'@'localhost';
GRANT SELECT ON assignment.use_ TO 'student'@'localhost';
GRANT SELECT ON assignment.question TO 'student'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON assignment.takenote TO 'student'@'localhost';
GRANT SELECT ON assignment.generaldescription TO 'student'@'localhost';
GRANT SELECT ON assignment.answer TO 'student'@'localhost';
GRANT SELECT ON assignment.questionanswer TO 'student'@'localhost';
GRANT SELECT ON assignment.answercontent TO 'student'@'localhost';
GRANT SELECT ON assignment.choose TO 'student'@'localhost';
GRANT SELECT ON assignment.subject TO 'student'@'localhost';
GRANT SELECT ON assignment.descriptioncontent TO 'student'@'localhost';
GRANT SELECT ON assignment.filedescription TO 'student'@'localhost';
GRANT SELECT ON assignment.containb TO 'student'@'localhost';
GRANT SELECT ON assignment.has TO 'student'@'localhost';


# admin
GRANT ALL PRIVILEGES ON assignment.* TO 'admin'@'localhost';

-- CREATE PROCEDURE
-- (i). Giáo viên phụ trách @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
USE assignment;

DROP PROCEDURE IF EXISTS suaCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE suaCauHoi(QUESID INT,
						   QUESTEXT CHAR(255),
						   QUESCONTENT CHAR(255),
						   QUESSUBJECTID INT,
						   QUESINCSSN CHAR(10),
						   QUESDATEUPLOAD DATE,
						   QUESDESCCONTID INT
)
	BEGIN
		UPDATE question 
        SET questiontext=ifnull(QUESTEXT,questiontext), content=ifnull(QUESCONTENT,content),
        subjectid=ifnull(QUESSUBJECTID,subjectid), incssn=ifnull(QUESINCSSN,incssn), 
        dateupload=ifnull(QUESDATEUPLOAD,dateupload), desccontid=ifnull(QUESDESCCONTID,desccontid)
        WHERE id=QUESID;
        
	END //
DELIMITER ;

DROP PROCEDURE IF EXISTS xoaCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE xoaCauHoi(QUESID INT
)
	BEGIN
		DELETE FROM question 
        WHERE id=QUESID;
        
	END //
DELIMITER ;

DROP PROCEDURE IF EXISTS themMoTaChungChoCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE themMoTaChungChoCauHoi(QUESID                    INT,
                                        GeneralDesccription_Id    INT)
	BEGIN
		INSERT INTO containb
        VALUES(GeneralDesccription_Id,QUESID);
	END //
DELIMITER ;

DROP PROCEDURE IF EXISTS suaMoTaChungCuaCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE suaMoTaChungCuaCauHoi(QUESID                        INT,
									   New_GeneralDesccription_Id    INT)
	BEGIN
		UPDATE containb
        SET DESCONID=New_GeneralDesccription_Id
        WHERE QUESTIONID = QUESID;
	END //
DELIMITER ;

DROP PROCEDURE IF EXISTS xoaMoTaChungChoCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE xoaMoTaChungChoCauHoi(QUESID                    INT,
									   GeneralDesccription_Id    INT)
	BEGIN
		DELETE FROM containb
        WHERE DESCONID=GeneralDesccription_Id AND QUESTIONID=QUESID;
	END //
DELIMITER ;


DROP PROCEDURE IF EXISTS themFileMoTaChoCauHoi;
DELIMITER //
-- Cập nhật các câu hỏi cho một môn học trong ngân hàng câu hỏi.
create PROCEDURE themFileMoTaChoCauHoi(QUESID            INT,
                                       Description_Id    INT                                 
)
	BEGIN
        UPDATE question
        SET DESCCONTID=IFNULL(Description_Id,NULL)
        WHERE ID=QUESID;
	END //
DELIMITER ;


DROP PROCEDURE IF EXISTS themCauTraLoiChoCauHoi;
DELIMITER //
-- 
CREATE PROCEDURE themCauTraLoiChoCauHoi(Question_Id    INT,
                                        Answer_Index   INT,
										Answer_Text    CHAR(255),
                                        Correctness    BOOL,
                                        Description_Id INT)
	Begin
         INSERT INTO answer VALUES(Question_Id,Answer_Index,Answer_Text,Correctness,IFNULL(Description_Id,NULL));        
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS suaCauTraLoiChoCauHoi;
DELIMITER //
-- 
CREATE PROCEDURE suaCauTraLoiChoCauHoi(Question_Id           INT,
									   Answer_Index          INT,
									   Answer_Text           CHAR(255),
									   Answer_Correctness    BOOL,
									   Description_Id        INT)
	Begin
         UPDATE answer
         SET ANSWERTEXT=IFNULL(Answer_Text,NULL), 
         CORRECTNESS=IFNULL(Answer_Correctness,NULL),
         DESCONTID=IFNULL(Description_Id,NULL)
         WHERE index_=Answer_Index AND questionid=Question_Id; 
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS xoaCauTraLoiCuaCauHoi;
DELIMITER //
-- 
CREATE PROCEDURE xoaCauTraLoiCuaCauHoi(Question_Id    INT,
									   Answer_Index   INT
)
	Begin
         DELETE FROM answer WHERE INDEX_=Answer_Index AND QUESTIONID=Question_Id;        
	end //
DELIMITER ;


DROP PROCEDURE IF EXISTS themCauHoi;
DELIMITER //
-- 
CREATE PROCEDURE themCauHoi(Question_Text       CHAR(255),
                            Question_Content    CHAR(255),
                            Question_Subject    INT,
                            Inc_SSN             CHAR(10),
                            Date_Upload         DATE,
                            Desccont_Id          INT)
	Begin
        INSERT INTO QUESTION(QUESTIONTEXT,CONTENT,SUBJECTID,INCSSN,DATEUPLOAD,DESCCONTID)
        VALUES(Question_Text,Question_Content,Question_Subject,Inc_SSN,Date_Upload,Desccont_Id);
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS themCauHoiVaoDeThi1MonHoc;
DELIMITER //
-- (i.2). Xây dựng các đề thi cho một môn học cho 1 lần thi cụ thể trong một học kỳ, ở một năm học.
CREATE PROCEDURE themCauHoiVaoDeThi1MonHoc(QuestionIdToInsert  INT,
									       Exam_Id             INT)
	Begin
        INSERT INTO use_(QUESTIONID,EXAMID)
        VALUES(QuestionIdToInsert,Exam_Id);
	end //
DELIMITER ;


DROP PROCEDURE IF EXISTS capNhatCauHoiTrongDeThi1MonHoc;
DELIMITER //
-- (i.2). Xây dựng các đề thi cho một môn học cho 1 lần thi cụ thể trong một học kỳ, ở một năm học.
CREATE PROCEDURE capNhatCauHoiTrongDeThi1MonHoc(QuestionIdToUpdate  INT,
									            NewQuestionId       INT,
									            Exam_Id             INT)
	Begin
        UPDATE use_ 
        SET QUESTIONID=NewQuestionId
        WHERE QUESTIONID=QuestionIdToUpdate AND EXAMID=Exam_Id;
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS xoaCauHoiTrongDeThi1MonHoc;
DELIMITER //
-- (i.2). Xây dựng các đề thi cho một môn học cho 1 lần thi cụ thể trong một học kỳ, ở một năm học.
CREATE PROCEDURE xoaCauHoiTrongDeThi1MonHoc(QuestionIdToDelete  INT,
										    Exam_Id             INT)
	Begin        
        DELETE FROM  use_ 
        WHERE QUESTIONID=QuestionIdToDelete AND EXAMID=Exam_Id;
	end //
DELIMITER ;

-- (i.3) Tạo view cho yêu cầu dữ liệu từ i3
DROP VIEW IF EXISTS Question_Exam_View;
CREATE VIEW Question_Exam_View AS
       SELECT exam.EXAMID, exam.EXAMDATE, exam.SUBJECTID, exam.EXAMLENGTH, exam.TITLE,question.ID AS QUESTION_ID, question.QUESTIONTEXT,
       generaldescription.ID AS GENERAL_ID,generaldescription.DESCRIPTIONTEXT,answer.INDEX_ , answer.ANSWERTEXT
       FROM exam INNER JOIN use_ ON exam.EXAMID=use_.EXAMID AND exam.EXAMDATE=use_.EXAMDATE
	   INNER JOIN question ON use_.QUESTIONID=question.ID
       LEFT JOIN containb ON question.ID=containb.QUESTIONID
       LEFT JOIN generaldescription ON containb.DESCONID=generaldescription.ID
	   INNER JOIN answer ON question.ID=answer.QUESTIONID;
       
DROP VIEW IF EXISTS questionfilecontent;
CREATE VIEW questionfilecontent AS
        SELECT question.ID AS QUESTION_ID,filedescription.ID AS FILE_ID_QUES,FILE AS FILE_QUES,FILESOURCE AS FILESOURCE_QUES FROM filedescription INNER JOIN question ON filedescription.ID=DESCCONTID;

DROP VIEW IF EXISTS answerfilecontent;
CREATE VIEW answerfilecontent AS
        SELECT answer.INDEX_ AS ANSWER_INDEX,answer.QUESTIONID AS QUES_ID,filedescription.ID AS FILE_ID_ANS,FILE AS FILE_ANS,FILESOURCE AS FILESOURCE_ANS FROM filedescription INNER JOIN answer ON filedescription.ID=DESCONTID;

DROP VIEW IF EXISTS generaldescriptionfilecontent;
CREATE VIEW generaldescriptionfilecontent AS
        SELECT generaldescription.ID AS GENERALDESCRIP_ID,filedescription.ID AS FILE_ID_GEN,FILE AS FILE_GEN,FILESOURCE AS FILESOURCE_GEN FROM filedescription INNER JOIN generaldescription ON filedescription.ID=DESCONID;
              
DROP PROCEDURE IF EXISTS xemDeThi1MonHoc;
DELIMITER //
-- (i.3). Xem các đề thi của một môn học cho 1 lần thi cụ thể trong 1 học kỳ, ở 1 năm học.
CREATE PROCEDURE xemDeThi1MonHoc(Subject_id	 INT,
                                 ExamTerm           INT,
							     AcademicStartYear  INT,
                                 AcademicEndYear    INT)
	Begin
        DROP TEMPORARY TABLE IF EXISTS exam_view;
        CREATE TEMPORARY TABLE exam_view AS
        SELECT Question_Exam_View.EXAMID,Question_Exam_View.EXAMDATE,Question_Exam_View.SUBJECTID,Question_Exam_View.EXAMLENGTH,
        Question_Exam_View.TITLE,Question_Exam_View.QUESTION_ID, Question_Exam_View.QUESTIONTEXT,
        questionfilecontent.FILE_QUES, questionfilecontent.FILESOURCE_QUES,
        Question_Exam_View.DESCRIPTIONTEXT,generaldescriptionfilecontent.FILESOURCE_GEN,
        Question_Exam_View.INDEX_, Question_Exam_View.ANSWERTEXT,answerfilecontent.FILE_ANS,answerfilecontent.FILESOURCE_ANS
        FROM Question_Exam_View LEFT JOIN generaldescriptionfilecontent ON GENERAL_ID=GENERALDESCRIP_ID
        LEFT JOIN answerfilecontent ON ANSWER_INDEX=INDEX_ AND QUES_ID=QUESTION_ID
        LEFT JOIN questionfilecontent ON Question_Exam_View.QUESTION_ID=questionfilecontent.QUESTION_ID;
        
		SELECT * FROM exam_view WHERE EXAMDATE IN (SELECT EXAMDATE FROM examtime WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear);
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS xemDanhSachSinhVien;
DELIMITER //
-- (i.4). Xem danh sách sinh viên tham dự 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemDanhSachSinhVien(Subject_id	 INT,
                                     ExamTerm           INT,
							         AcademicStartYear  INT,
                                     AcademicEndYear    INT)
	Begin
		SELECT * FROM student WHERE ID IN (SELECT STUDENTID FROM questionanswer WHERE EXAMID IN (SELECT EXAMID FROM exam WHERE EXAMDATE IN (SELECT EXAMDATE FROM examtime WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear)));
	end //
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


DROP PROCEDURE IF EXISTS xemKetQuaBaiLamSinhVien;
DELIMITER //
-- Xem kết quả bài làm của một sinh viên tham dự 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemKetQuaBaiLamSinhVien(student_id         INT, 
										 Subject_id	     INT,
                                         ExamTerm           INT,
								         AcademicStartYear  INT,
								         AcademicEndYear    INT)
    Begin
        
		DROP TEMPORARY TABLE IF EXISTS diem;
        CREATE TEMPORARY TABLE IF NOT EXISTS diem (
			   MaSinhVien    INT,
               Diem       DECIMAL(4,2)
        );
        
        INSERT INTO diem VALUES(student_id, tinhDiemSinhVien(student_id, Subject_id, ExamTerm, AcademicStartYear, AcademicEndYear));
        
        DROP TEMPORARY TABLE IF EXISTS bailam;
        CREATE TEMPORARY TABLE bailam AS
        SELECT * FROM questionanswer WHERE STUDENTID=student_id AND EXAMID=(SELECT EXAMID FROM exam 
        WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
        WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear));
        
        SELECT bailam.*,diem.Diem FROM diem INNER JOIN bailam ON diem.MaSinhVien = bailam.STUDENTID;
	
	end //                                       

DELIMITER ;

DROP PROCEDURE IF EXISTS xemDiemSinhVien;;
DELIMITER //
-- Xem điểm của các sinh viên tham dự 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemDiemSinhVien(Subject_id	     INT,
								 ExamTerm           INT,
								 AcademicStartYear  INT,
								 AcademicEndYear    INT)
    Begin
        DECLARE i INT DEFAULT 0;
		DECLARE n INT DEFAULT 0;
        DECLARE sv INT DEFAULT 0;
        
        
		DROP TEMPORARY TABLE IF EXISTS diemSV;
        CREATE TEMPORARY TABLE IF NOT EXISTS diemSV(
			   MaSinhVien    INT,
               Diem       DECIMAL(4,2)
        );
        
        DROP TEMPORARY TABLE IF EXISTS danhsachSV;
        CREATE TEMPORARY TABLE danhsachSV AS
        SELECT STUDENTID FROM questionanswer WHERE EXAMID=(SELECT EXAMID FROM exam 
		WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
		WHERE SUBJECTID=Subject_id AND TERM=ExamTerm AND STARTYEAR=AcademicStartYear AND ENDYEAR=AcademicEndYear LIMIT 1) LIMIT 1);
        
        SELECT COUNT(*) FROM danhsachSV INTO n;        
        
        SET i=0;
        SET sv=0;
        WHILE i<n DO
          SET sv = (SELECT STUDENTID FROM danhsachSV LIMIT i,1);
          INSERT INTO diemSV VALUES(sv, tinhDiemSinhVien(sv, Subject_id, ExamTerm, AcademicStartYear, AcademicEndYear));
          SET i = i + 1;
		END WHILE;
        
        SELECT * FROM diemSV;
	end //                                       

DELIMITER ;

DROP PROCEDURE IF EXISTS xemSoSinhVienLamDungi7;
DELIMITER //
-- Xem số sinh viên làm đúng, số sinh viên làm sai cho một câu hỏi cho 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemSoSinhVienLamDungi7(Question_Id 	        INT, 
							            Subject_Id 	            INT,
										Exam_Term 	            INT,
							            Academic_StartYear		INT,
							            Academic_EndYear 	 	INT
)
	Begin
        DECLARE num_of_students INT DEFAULT 0;
		SET num_of_students = (SELECT COUNT(*) FROM questionanswer WHERE EXAMID=(SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1) LIMIT 0,1));
        
        DROP TEMPORARY TABLE IF EXISTS ket_qua;
        CREATE TEMPORARY TABLE ket_qua
        SELECT STUDENTID,kiemTraCauTraLoiDung(ID) AS RESULT FROM answercontent WHERE QUESTIONID=Question_Id AND EXAMID=(SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1) LIMIT 0,1);
		
        SELECT COUNT(*) AS SoSinhVienLamDung, num_of_students - COUNT(*) AS SoSinhVienLamSai FROM ket_qua WHERE RESULT=TRUE;
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS xemTiLeSoSinhVienLamDungi8;
DELIMITER //
-- Xem tỉ lệ số_sinh_viên_làm_đúng*100/tổng_số_sinh_viên cho mỗi chuẩn đầu ra môn học được đánh giá với các câu hỏi cho 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemTiLeSoSinhVienLamDungi8(Subject_Id 	                INT,
							                Exam_Term 	                INT,
							                Academic_StartYear			INT,
							                Academic_EndYear 	 	    INT
)
	Begin
        DECLARE num_of_students INT DEFAULT 0;
		SET num_of_students = (SELECT COUNT(DISTINCT STUDENTID) FROM questionanswer WHERE EXAMID IN (SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1)));
	    
        
		DROP TEMPORARY TABLE IF EXISTS ques_doing;
        CREATE TEMPORARY TABLE ques_doing AS
        SELECT question.CONTENT AS CONTENT,answercontent.*,kiemTraCauTraLoiDung(answercontent.ID) AS RESULT FROM question INNER JOIN answercontent ON question.ID=answercontent.QUESTIONID WHERE EXAMID IN (SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1));
		
        DROP TEMPORARY TABLE IF EXISTS num_ques_standard;
        CREATE TEMPORARY TABLE num_ques_standard AS
        SELECT standard.CONTENT,COUNT(ID) AS NUM_OF_QUES FROM question 
        INNER JOIN standard ON question.CONTENT = standard.CONTENT
        AND standard.SUBJECTID = Subject_Id
        GROUP BY CONTENT;
		
        DROP TEMPORARY TABLE IF EXISTS adhoc;
        CREATE TEMPORARY TABLE adhoc AS
        SELECT CONTENT,COUNT(*) AS NUM_OF_CORRECT_STU FROM (SELECT *,COUNT(STUDENTID) AS NUMS_OF_CORRECT FROM (SELECT ques_doing.*,num_ques_standard.NUM_OF_QUES FROM ques_doing INNER JOIN num_ques_standard ON ques_doing.CONTENT = num_ques_standard.CONTENT AND RESULT=1)temp GROUP BY CONTENT,STUDENTID HAVING NUMS_OF_CORRECT = NUM_OF_QUES)temp3 GROUP BY CONTENT;
        
        SELECT num_ques_standard.CONTENT,CAST(IFNULL(NUM_OF_CORRECT_STU, 0)*100 AS DECIMAL(4,2))/CAST(num_of_students AS DECIMAL(4,2)) AS CORRECT_RATIO FROM num_ques_standard LEFT JOIN adhoc ON num_ques_standard.CONTENT = adhoc.CONTENT;
	
        
	end //
DELIMITER ;


DROP PROCEDURE IF EXISTS xem5CauHoiLamSaiNhieuNhat;
DELIMITER //
-- Xem 5 câu hỏi có số sinh viên làm sai nhiều nhất cho 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xem5CauHoiLamSaiNhieuNhat(Subject_Id 	                INT,
							               Exam_Term 	                INT,
							               Academic_StartYear			INT,
							               Academic_EndYear 	 	    INT
)
	Begin
        
        CREATE TEMPORARY TABLE ques_false
        SELECT answercontent.*,kiemTraCauTraLoiDung(answercontent.ID) AS RESULT FROM answercontent 
                               WHERE kiemTraCauTraLoiDung(answercontent.ID)=FALSE AND EXAMID=(SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1) LIMIT 0,1); 
		
        SELECT QUESTIONID,COUNT(*) AS NUM_OF_NOTPASS_STU FROM ques_false GROUP BY QUESTIONID ORDER BY NUM_OF_NOTPASS_STU LIMIT 5;
        
	end //
DELIMITER ;

DROP PROCEDURE IF EXISTS xemCacCauHoiLamSaiNhieuNhat;
DELIMITER //
-- Xem các câu hỏi có số sinh viên làm sai nhiều nhất trong các lần thi đã được thực hiện cho một môn học.
CREATE PROCEDURE xemCacCauHoiLamSaiNhieuNhat(Subject_Id 	INT)
	Begin
        
        DROP TEMPORARY TABLE IF EXISTS ques_done;
        CREATE TEMPORARY TABLE ques_done
        SELECT answercontent.*,kiemTraCauTraLoiDung(answercontent.ID) AS RESULT FROM answercontent 
                               WHERE kiemTraCauTraLoiDung(answercontent.ID)=FALSE AND EXAMID IN (SELECT EXAMID FROM exam 
							   WHERE EXAMDATE IN (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id)); 
		
        SELECT QUESTIONID,COUNT(*) AS NUM_OF_NOTPASS_STU FROM ques_done GROUP BY QUESTIONID ORDER BY NUM_OF_NOTPASS_STU DESC LIMIT 10;
        
	end //
DELIMITER ;


DROP PROCEDURE IF EXISTS xemCacTiLeSoSinhVienLamDungi11;
DELIMITER //
-- Xem các chuẩn đầu ra môn học có tỉ lệ số_sinh_viên_làm_đúng*100/tổng_số_sinh_viên thấp nhất cho 1 lần thi cụ thể của một môn học trong một học kỳ, ở một năm học.
CREATE PROCEDURE xemCacTiLeSoSinhVienLamDungi11(Subject_Id 	                INT,
							                Exam_Term 	                INT,
							                Academic_StartYear			INT,
							                Academic_EndYear 	 	    INT
)
	Begin
		DECLARE num_of_students INT DEFAULT 0;
		SET num_of_students = (SELECT COUNT(DISTINCT STUDENTID) FROM questionanswer WHERE EXAMID IN (SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1)));
	    
        
		DROP TEMPORARY TABLE IF EXISTS ques_did;
        CREATE TEMPORARY TABLE ques_did AS
        SELECT question.CONTENT AS CONTENT,answercontent.*,kiemTraCauTraLoiDung(answercontent.ID) AS RESULT FROM question INNER JOIN answercontent ON question.ID=answercontent.QUESTIONID WHERE EXAMID IN (SELECT EXAMID FROM exam 
							   WHERE EXAMDATE = (SELECT EXAMDATE FROM examtime 
							   WHERE SUBJECTID=Subject_Id AND TERM=Exam_Term AND STARTYEAR=Academic_StartYear AND ENDYEAR=Academic_EndYear LIMIT 0,1));
		
        DROP TEMPORARY TABLE IF EXISTS num_ques_standard1;
        CREATE TEMPORARY TABLE num_ques_standard1 AS
        SELECT standard.CONTENT,COUNT(ID) AS NUM_OF_QUES FROM question 
        INNER JOIN standard ON question.CONTENT = standard.CONTENT
        AND standard.SUBJECTID = Subject_Id
        GROUP BY CONTENT;
		
        DROP TEMPORARY TABLE IF EXISTS adhoc1;
        CREATE TEMPORARY TABLE adhoc1 AS
        SELECT CONTENT,COUNT(*) AS NUM_OF_CORRECT_STU FROM (SELECT *,COUNT(STUDENTID) AS NUMS_OF_CORRECT FROM (SELECT ques_did.*,num_ques_standard1.NUM_OF_QUES FROM ques_did INNER JOIN num_ques_standard1 ON ques_did.CONTENT = num_ques_standard1.CONTENT AND RESULT=1)temp GROUP BY CONTENT,STUDENTID HAVING NUMS_OF_CORRECT = NUM_OF_QUES)temp3 GROUP BY CONTENT;
        
        SELECT num_ques_standard1.CONTENT,CAST(IFNULL(NUM_OF_CORRECT_STU, 0)*100 AS DECIMAL(4,2))/CAST(num_of_students AS DECIMAL(4,2)) AS CORRECT_RATIO FROM num_ques_standard1 LEFT JOIN adhoc1 ON num_ques_standard1.CONTENT = adhoc1.CONTENT ORDER BY CORRECT_RATIO ASC LIMIT 10;
        
	end //
DELIMITER ;


DROP PROCEDURE IF EXISTS xemCacTiLeSoSinhVienLamDung3LanGanNhat;
DELIMITER //
-- Xem các chuẩn đầu ra môn học có tỉ lệ số_sinh_viên_làm_đúng*100/tổng_số_sinh_viên thấp nhất trong 3 lần thi liên tiếp gần nhất của một môn học.
CREATE PROCEDURE xemCacTiLeSoSinhVienLamDung3LanGanNhat(Subject_Id 	   INT)
	Begin
        DECLARE students_count INT DEFAULT 0;
			
		DROP TEMPORARY TABLE IF EXISTS count_student;
        CREATE TEMPORARY TABLE count_student AS
		SELECT EXAMDATE,COUNT(DISTINCT STUDENTID) AS NUMS_OF_STUDENTS FROM questionanswer INNER JOIN (SELECT exam.EXAMDATE,EXAMID FROM exam INNER JOIN (SELECT EXAMDATE FROM examtime 
		WHERE SUBJECTID=Subject_Id ORDER BY EXAMDATE DESC LIMIT 3)razor ON exam.EXAMDATE=razor.EXAMDATE)chaos ON questionanswer.EXAMID=chaos.EXAMID GROUP BY EXAMDATE;
	    SELECT SUM(NUMS_OF_STUDENTS) FROM count_student INTO students_count;
        
		DROP TEMPORARY TABLE IF EXISTS wraith;
        CREATE TEMPORARY TABLE wraith AS
        SELECT question.CONTENT AS CONTENT,answercontent.*,kiemTraCauTraLoiDung(answercontent.ID) AS RESULT FROM question 
        INNER JOIN answercontent ON question.ID=answercontent.QUESTIONID 
        INNER JOIN (SELECT EXAMID FROM exam INNER JOIN (SELECT EXAMDATE FROM examtime 
		WHERE SUBJECTID=Subject_Id ORDER BY EXAMDATE DESC LIMIT 3)razor ON exam.EXAMDATE=razor.EXAMDATE)chaos ON answercontent.EXAMID=chaos.EXAMID;
		
        DROP TEMPORARY TABLE IF EXISTS num_question_standard;
        CREATE TEMPORARY TABLE num_question_standard AS
        SELECT standard.CONTENT,COUNT(ID) AS NUM_OF_QUES FROM question 
        INNER JOIN standard ON question.CONTENT = standard.CONTENT
        AND standard.SUBJECTID = Subject_Id
        GROUP BY CONTENT;
        
		
        DROP TEMPORARY TABLE IF EXISTS shadowfiend;
        CREATE TEMPORARY TABLE shadowfiend AS
        SELECT CONTENT,COUNT(*) AS NUM_OF_CORRECT_STU 
        FROM (SELECT *,COUNT(STUDENTID) AS NUMS_OF_CORRECT 
        FROM (SELECT wraith.*,num_question_standard.NUM_OF_QUES 
        FROM wraith INNER JOIN num_question_standard 
        ON wraith.CONTENT = num_question_standard.CONTENT AND RESULT=1)temp 
        GROUP BY CONTENT,STUDENTID HAVING NUMS_OF_CORRECT = NUM_OF_QUES)temp3 GROUP BY CONTENT;
        
        SELECT num_question_standard.CONTENT,CAST(IFNULL(NUM_OF_CORRECT_STU, 0)*100 AS DECIMAL(4,2))/CAST(students_count AS DECIMAL(4,2)) AS CORRECT_RATIO FROM num_question_standard LEFT JOIN shadowfiend ON num_question_standard.CONTENT = shadowfiend.CONTENT ORDER BY CORRECT_RATIO ASC LIMIT 10;
	end //
DELIMITER ;



GRANT EXECUTE ON PROCEDURE assignment.suaCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.suaCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themMoTaChungChoCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themMoTaChungChoCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.suaMoTaChungCuaCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.suaMoTaChungCuaCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaMoTaChungChoCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaMoTaChungChoCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themFileMoTaChoCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themFileMoTaChoCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauTraLoiChoCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauTraLoiChoCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.suaCauTraLoiChoCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.suaCauTraLoiChoCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauTraLoiCuaCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauTraLoiCuaCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauHoi TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauHoi TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauHoiVaoDeThi1MonHoc TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.themCauHoiVaoDeThi1MonHoc TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.capNhatCauHoiTrongDeThi1MonHoc TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.capNhatCauHoiTrongDeThi1MonHoc TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauHoiTrongDeThi1MonHoc TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xoaCauHoiTrongDeThi1MonHoc TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDeThi1MonHoc TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDeThi1MonHoc TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDanhSachSinhVien TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemKetQuaBaiLamSinhVien TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDiemSinhVien TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemDiemSinhVien TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemSoSinhVienLamDungi7 TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemSoSinhVienLamDungi7 TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemTiLeSoSinhVienLamDungi8 TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemTiLeSoSinhVienLamDungi8 TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xem5CauHoiLamSaiNhieuNhat TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xem5CauHoiLamSaiNhieuNhat TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacCauHoiLamSaiNhieuNhat TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacCauHoiLamSaiNhieuNhat TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacTiLeSoSinhVienLamDungi11 TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacTiLeSoSinhVienLamDungi11 TO 'subject_management'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacTiLeSoSinhVienLamDung3LanGanNhat TO 'incharge'@'localhost';
GRANT EXECUTE ON PROCEDURE assignment.xemCacTiLeSoSinhVienLamDung3LanGanNhat TO 'subject_management'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.kiemTraCauTraLoiDung TO 'incharge'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.kiemTraCauTraLoiDung TO 'subject_management'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.tinhDiemSinhVien TO 'incharge'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.tinhDiemSinhVien TO 'subject_management'@'localhost';

GRANT EXECUTE ON FUNCTION assignment.kiemTraCauTraLoiDung TO 'student'@'localhost';
GRANT EXECUTE ON FUNCTION assignment.tinhDiemSinhVien TO 'student'@'localhost';
