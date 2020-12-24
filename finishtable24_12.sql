-- CREATE TABLE
create database assignment;
USE ASSIGNMENT;
CREATE TABLE EMPLOYEE(
SSN CHAR(10),
FNAME CHAR(10),
MNAME CHAR(10),
LNAME CHAR(10),
BIRTHDAY DATE,
GENDER CHAR,
EMAIL CHAR(20),
PHONENUMBER CHAR(10),
EXPERIENCE INT,
IDPASSWORD CHAR(20),
PASSWORD CHAR(20),
ADDRESS VARCHAR(50),
SPECIFICATION CHAR(20),
PRIMARY KEY(SSN)
);

CREATE TABLE SUBJECTMANAGEMENTTEACHER (
SUBSSN CHAR(10),
primary key (SUBSSN),
foreign key(SUBSSN) references EMPLOYEE(SSN)
);

CREATE TABLE INCHARGETEACHER(
INCSSN CHAR(10),
primary key(INCSSN),
foreign key(INCSSN) references EMPLOYEE(SSN)
);
CREATE TABLE SUBJECT(
SUBJECTID INT,
SUBJECTNAME CHAR(20),
SUBSSN CHAR(10) NOT NULL,
primary key(SUBJECTID),
foreign key(SUBSSN) references SUBJECTMANAGEMENTTEACHER(SUBSSN)
);

CREATE TABLE DESCRIPTIONCONTENT(
ID INT,
primary key(ID)
);

CREATE TABLE STANDARD(
CONTENT CHAR(255),
SUBJECTID INT,
primary key(CONTENT,SUBJECTID),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID)
);


CREATE TABLE QUESTION(
ID INT auto_increment,
QUESTIONTEXT CHAR(255),
CONTENT CHAR(255) NOT NULL,
SUBJECTID INT NOT NULL,
INCSSN CHAR(10) NOT NULL,
DATEUPLOAD DATE,
DESCCONTID  INT,
primary key(ID),
foreign key(CONTENT, SUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN),
foreign key(DESCCONTID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE FILEDESCRIPTION(
ID INT,
FILESOURCE CHAR(20),
FILE CHAR(20),
primary key(ID)
);

CREATE TABLE GENERALDESCRIPTION(
ID       INT,
DESCONID INT,
DESCRIPTIONTEXT CHAR(255),
primary key(ID),
foreign key(DESCONID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE STUDENT(
ID INT,
FNAME CHAR(10),
MNAME CHAR(10),
LNAME CHAR(10),
GENDER CHAR,
BIRTHDAY DATE,
PHONENUMBER CHAR(10),
EMAIL CHAR(20),
IDPASSWORD CHAR(20),
PASSWORD CHAR(20),
ADDRESS VARCHAR(50),
primary key(ID)
);

CREATE TABLE EXAMTIME(
EXAMDATE DATE,
SUBJECTID INT,
STARTYEAR INT,
ENDYEAR INT,
TERM    INT,
NUMS_EXAM INT,
CHECK (NUMS_EXAM>1),
primary key(EXAMDATE,SUBJECTID),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID)
);

CREATE TABLE EXAM(
EXAMID INT ,
EXAMDATE DATE,
SUBJECTID INT,
NOTE CHAR(255),
EXAMLENGTH INT,
TITLE CHAR(20),
INCSSN CHAR(10) NOT NULL,
CONFIRMDATE DATE,
APPROVALDATE DATE,
SUBSSN CHAR(10) NOT NULL,
CHECK (CONFIRMDATE <= APPROVALDATE AND APPROVALDATE <= EXAMDATE - 3),
primary key(EXAMID,EXAMDATE,SUBJECTID),
foreign key(EXAMDATE, SUBJECTID) references EXAMTIME(EXAMDATE, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN),
foreign key(SUBSSN) references SUBJECTMANAGEMENTTEACHER(SUBSSN)
);

CREATE TABLE ANSWER(
INDEX_ INT,
QUESTIONID INT,
ANSWERTEXT CHAR(20),
CORRECTNESS BOOL,
DESCONTID  INT,
CHECK (INDEX_>0 AND INDEX_<6),
primary key(INDEX_,QUESTIONID),
foreign key(QUESTIONID) references QUESTION(ID),
foreign key(DESCONTID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE QUESTIONREPRESENTATION(
ID INT,
QUESTIONID INT,
EXAMDATE DATE,
primary key(ID, QUESTIONID, EXAMDATE),
foreign key (QUESTIONID) references QUESTION(ID),
foreign key(EXAMDATE) references EXAMTIME(EXAMDATE)
);

CREATE TABLE QUESTIONANSWER(
ID INT,
STUDENTID INT,
EXAMID INT,
DATEANDTIME DATETIME,
primary key(ID, STUDENTID, EXAMID),
foreign key(STUDENTID) references STUDENT(ID),
foreign key(EXAMID) references EXAM(EXAMID)
);

CREATE TABLE ANSWERCONTENT(
ID INT,
QUESTIONANSWERID INT,
STUDENTID INT,
EXAMID INT,
QUESTIONID INT,
primary key(ID,QUESTIONANSWERID,STUDENTID,EXAMID),
foreign key( QUESTIONANSWERID, STUDENTID, EXAMID) references QUESTIONANSWER(ID, STUDENTID, EXAMID),
foreign key(QUESTIONID) references QUESTION(ID)
);
CREATE TABLE MAKE(
EXAMID INT,
INCSSN CHAR(10),
primary key(EXAMID),
foreign key (INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE USE_(
ID INT auto_increment,
QUESTIONID INT,
EXAMDATE DATE,
EXAMID INT,
primary key(ID,QUESTIONID,EXAMDATE),
foreign key(ID, QUESTIONID, EXAMDATE) references QUESTIONREPRESENTATION(ID, QUESTIONID, EXAMDATE)
);

CREATE TABLE CONTAINA(
SUBSTANDARDCONTENT CHAR(20),
SUBSTANDARDSUBJECTID INT,
MAINSTANDARDCONTENT CHAR(20),
MAINSTANDARDSUBJECTID INT,
primary key(SUBSTANDARDCONTENT, SUBSTANDARDSUBJECTID),
foreign key(SUBSTANDARDCONTENT, SUBSTANDARDSUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(MAINSTANDARDCONTENT, MAINSTANDARDSUBJECTID) references STANDARD(CONTENT, SUBJECTID)
);

CREATE TABLE UPDATE_(
CONTENT CHAR(20),
SUBJECTID INT,
INCSSN CHAR(10),
primary key(CONTENT, SUBJECTID, INCSSN),
foreign key(CONTENT, SUBJECTID) references STANDARD(CONTENT, SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE TEACH(
SUBJECTID INT,
INCSSN CHAR(10),
primary key(SUBJECTID, INCSSN),
foreign key(SUBJECTID) references SUBJECT(SUBJECTID),
foreign key(INCSSN) references INCHARGETEACHER(INCSSN)
);

CREATE TABLE CONTAINB(
DESCONID INT,
QUESTIONID INT,
primary key(DESCONID, QUESTIONID),
foreign key(DESCONID) references GENERALDESCRIPTION(ID),
foreign key(QUESTIONID) references QUESTION(ID)
);

CREATE TABLE HAS(
FILEDESID INT,
DESCONID INT,
primary key(FILEDESID, DESCONID),
foreign key(FILEDESID) references FILEDESCRIPTION(ID),
foreign key(DESCONID) references DESCRIPTIONCONTENT(ID)
);

CREATE TABLE TAKENOTE(
STUDENTID INT,
EXAMID INT,
NOTE CHAR(255),
DATEANDTIME DATETIME,
primary key(STUDENTID, EXAMID),
foreign key(STUDENTID) references STUDENT(ID),
foreign key(EXAMID) references EXAM(EXAMID)
);
CREATE TABLE CHOOSE(
ANSWERCHOOSE INT,
ANSWERCONTENTID INT,
QUESTIONANSWERID INT,
STUDENTID INT,
EXAMID INT,
primary key(ANSWERCHOOSE, ANSWERCONTENTID, QUESTIONANSWERID, STUDENTID,EXAMID),
foreign key(ANSWERCONTENTID, QUESTIONANSWERID, STUDENTID, EXAMID) references ANSWERCONTENT(ID, QUESTIONANSWERID,STUDENTID,EXAMID)
);

 CREATE TABLE DIEM(
 STUDENTID INT,
 EXAMID INT,
 DIEM DECIMAL(4,2)
 );
