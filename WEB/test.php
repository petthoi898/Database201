<?php
include('connect.php');
include('control.php');
$Subject_id = 2005;
$ExamTerm = 1;
$AcademicStartYear = 2020;
$AcademicEndYear = 2021;
$Question_Id = 1;
$QUESTION_ID = 1;
$ID = 1;
$stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear)");
$stmt->execute();
// set the resulting array to associative

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

while ($row = $stmt->fetch()) {

    if ($row['INDEX_'] == 1) echo  $row['QUESTION_ID'] . ". " . $row['QUESTIONTEXT'] . "<br>";
    $QUESTION_ID = $row['QUESTION_ID'];
    $INDEX_ = $row['INDEX_'];
    $stmt2 = $conn->prepare("SELECT * FROM `answercontent` WHERE  EXAMID ='1' AND `STUDENTID` =$ID and ");
    $stmt2->execute();
    // set the resulting array to associative

    $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    while ($row2 = $stmt2->fetch()) {

        if($row['INDEX_'] == $row2['ANSWERCHOOSE']){
            if ($row['INDEX_'] == 1) {
                echo "<p style = 'padding-left: 40px'>A. " . $row['ANSWERTEXT'] . "</p>";
            } else if ($row['INDEX_'] == 2) {
                echo "<p style = 'padding-left: 40px'>B. " . $row['ANSWERTEXT'] . "</p>";
            } else if ($row['INDEX_'] == 3) {
                echo "<p style = 'padding-left: 40px'>C. " . $row['ANSWERTEXT'] . "</p>";
            } else if ($row['INDEX_'] == 4) {
                echo "<p style = 'padding-left: 40px'>D. " . $row['ANSWERTEXT'] . "</p>";
            }
        }else{
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
