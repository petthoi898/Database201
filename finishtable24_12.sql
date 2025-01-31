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
 SUBJECTID INT(11),
 STARTYEAR INT(11),
 ENDYEAR INT(11),
 TERM INT(11),
 DIEM DECIMAL(4,2)
 );
