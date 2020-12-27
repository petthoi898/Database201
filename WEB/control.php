<?php

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<!-- get data -->



<?php
function showListStudent($conn, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemDanhSachSinhVien($Subject_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:10px'>";
    echo "<tr><th>Id</th><th>FNAME</th><th>MNAME</th><th>LNAME</th><th>GENDER</th><th>BIRTHDAY</th><th>EMAIL</th><th>ADDRESS</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 50px; border: 1px solid black;'>" . $row['ID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['FNAME'] . "</td>";
        echo "<td style='width: 70px; border: 1px solid black;'>" . $row['MNAME'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['LNAME'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['GENDER'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['BIRTHDAY'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['EMAIL'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['ADDRESS'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<?php
function showScoresStudent($conn, $student_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemDiemSinhVien($student_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>ID</th><th>Diem</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['ID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['Diem'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php


function insertQuestion(
    $conn,
    $QUESTEXT,
    $QUESCONTENT,
    $QUESSUBJECTID,
    $QUESINCSSN,
    $QUESDATEUPLOAD,
    $QUESDESCCONTID
) {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("call themCauHoi(?,?,?,?,?,?)");
        $stmt->bindParam(1, $QUESTEXT); 
        $stmt->bindParam(2, $QUESCONTENT); 
        $stmt->bindParam(3, $QUESSUBJECTID); 
        $stmt->bindParam(4, $QUESINCSSN); 
        $stmt->bindParam(5, $QUESDATEUPLOAD); 
        $stmt->bindParam(6, $QUESDESCCONTID); 

        $stmt->execute();
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "New record created failed";
    }
}
?>

<?php
function showResultStudent($conn, $student_id, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemKetQuaBaiLamSinhVien($student_id,$Subject_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>ID</th><th>ExamID</th><th>Question ID</th><th>Student ID</th><th>Date time</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['ID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['EXAMID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['QUESTIONANSWERID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['	STUDENTID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['DATEANDTIME'] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php
function showCorrectStudents($conn, $Question_Id, $Subject_Id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemSoSinhVienLamDungi7($Question_Id, $Subject_Id,$ExamTerm, $AcademicStartYear, $AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {
        echo $stmt->fetch();
    }
}
?>
<?php
function showRateCorrectStudents($conn, $Question_Id, $Subject_Id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemSoSinhVienLamDungi8($Question_Id, $Subject_Id,$ExamTerm, $AcademicStartYear, $AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {
        echo $stmt->fetch();
    }
}
?>



<?php
function show5IncorrectQuestion($conn, $Subject_Id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xem5CauHoiLamSaiNhieuNhat($Subject_Id,$ExamTerm, $AcademicStartYear, $AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>ID</th><th>Question text</th><th>Content</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['ID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['QUESTIONTEXT'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['CONTENT'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>


<?php
function showStudentCorrect3Times($conn, $Subject_Id)
{
    $stmt = $conn->prepare("call xemCacTiLeSoSinhVienLamDung3LanGanNhat($Subject_Id)");
    $stmt->execute();
    // set the resulting array to associative

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>EXAMDATE</th><th>CONTENT</th><th>COUNT</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['EXAMDATE'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['CONTENT'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['COUNT'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<?php

function showExam($conn, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {

        if ($row['INDEX_'] == 1) echo  $row['QUESTION_ID'] . ". " . $row['QUESTIONTEXT'] . "<br>";

        if ($row['INDEX_'] == 1) {
            echo "<p style = 'padding-left: 40px'>A. " . $row['ANSWERTEXT'] . "</p>";
        } else if ($row['INDEX_'] == 2) {
            echo "<p style = 'padding-left: 40px'>B. " . $row['ANSWERTEXT'] . "</p>";
        } else if ($row['INDEX_'] == 3) {
            echo "<p style = 'padding-left: 40px'>C. " . $row['ANSWERTEXT'] . "</p>";
        } else if ($row['INDEX_'] == 4) {
            echo "<p style = 'padding-left: 40px'>D. " . $row['ANSWERTEXT'] . "</p>";
        }
    }
}
?>
<?php
function showAnswer($conn, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {

        if ($row['INDEX_'] == 1) echo  $row['QUESTION_ID'] . ". " . $row['QUESTIONTEXT'] . "<br>";
        $QUESTION_ID = $row['QUESTION_ID'];
        $INDEX_ = $row['INDEX_'];
        $stmt2 = $conn->prepare("SELECT * FROM `answer` WHERE `QUESTIONID` = $QUESTION_ID and  `INDEX_` =$INDEX_ ");
        $stmt2->execute();
        // set the resulting array to associative

        $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        while ($row2 = $stmt2->fetch()) {

            if ($row2['CORRECTNESS'] == 0){
                if ($row['INDEX_'] == 1) {
                    echo "<p style = 'padding-left: 40px'>A. " . $row['ANSWERTEXT'] . "</p>";
                } else if ($row['INDEX_'] == 2) {
                    echo "<p style = 'padding-left: 40px'>B. " . $row['ANSWERTEXT'] . "</p>";
                } else if ($row['INDEX_'] == 3) {
                    echo "<p style = 'padding-left: 40px'>C. " . $row['ANSWERTEXT'] . "</p>";
                } else if ($row['INDEX_'] == 4) {
                    echo "<p style = 'padding-left: 40px'>D. " . $row['ANSWERTEXT'] . "</p>";
                }
            }
            
        }

        
    }
}
?>

<?php
function checkAnswer($conn, $QUESTION_ID, $INDEX_)
{
    $stmt2 = $conn->prepare("SELECT * FROM `answer` WHERE `QUESTIONID` = $QUESTION_ID and  `INDEX_` =$INDEX_ ");
    $stmt2->execute();
    // set the resulting array to associative

    $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    while ($row2 = $stmt2->fetch()) {

        if ($row2['CORRECTNESS'] == 0) return false;
        else return true;
    }
}
?>