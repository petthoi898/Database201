<?php
include('connect.php');
$Subject_Id = 2005;
$ExamTerm = 1;
$AcademicStartYear = 2020;
$AcademicEndYear = 2021;
$Question_Id = 1;


$stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_Id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear)");
$stmt->execute();
// set the resulting array to associative

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

while ($row = $stmt->fetch()) {

    echo  $row['QUESTION_ID'].". " .$row['QUESTIONTEXT'] . "<br>";
    $EXAMID = $row['EXAMID'] ;
    $SUBJECTID = $row['SUBJECTID'];
    $QUESTION_ID = $row['QUESTION_ID'];
    $stmt2 = $conn->prepare("SELECT * FROM `Question_Exam_View` WHERE `EXAMID` = $EXAMID AND `SUBJECTID` = $SUBJECTID AND `QUESTION_ID` = $QUESTION_ID ");
    $stmt2->execute();
    

    $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);

    while ($row2 = $stmt2->fetch()) {
        


        if ($row2['INDEX_'] == 1) {
            echo "<p style = 'padding-left: 40px'>A. " . $row2['ANSWERTEXT'] . "</p>";
        } else if ($row2['INDEX_'] == 2) {
            echo "<p style = 'padding-left: 40px'>B. " . $row2['ANSWERTEXT'] . "</p>";
        } else if ($row2['INDEX_'] == 3) {
            echo "<p style = 'padding-left: 40px'>C. " . $row2['ANSWERTEXT'] . "</p>";
        } else if ($row2['INDEX_'] == 4) {
            echo "<p style = 'padding-left: 40px'>D. " . $row2['ANSWERTEXT'] . "</p>";
        }
    }
    continue;
}
