<?php
include('../header.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('../connect.php');
include('../control.php');
$count = 0;
$score = 0;
foreach ($_POST['questionID'] as $questionId) {
    $count++;
    $answer = $_POST['question_' . $questionId];

    $stmt2 = $conn->prepare("SELECT * FROM `answer` WHERE `QUESTIONID` = $questionId and  `INDEX_` =$answer ");
    $stmt2->execute();
    // set the resulting array to associative

    $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    while ($row2 = $stmt2->fetch()) {

        if ($row2['CORRECTNESS'] == 1) {
            $score++;
            break;
        }
    }
}
$final = $score / $count * 10;
?>
<p>Bạn đã trả lời đúng <?php echo  $score ?> / <?php echo  $count ?></p>

<?php
// $Subject_id = 2005;
// $ExamTerm = 1;
// $AcademicStartYear = 2020;
// $AcademicEndYear = 2021;
// $Question_Id = 1;
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $stmt = $conn->prepare("INSERT INTO `diem` (`STUDENTID`, `SUBJECTID`, `STARTYEAR`, `ENDYEAR`, `TERM`, `DIEM`) VALUES (?, ?, ?,?, ?, ?);");
// $stmt->bindParam(1, 1);
// $stmt->bindParam(2, $Subject_id);

// $stmt->bindParam(3, $AcademicStartYear);
// $stmt->bindParam(4, $AcademicEndYear);
// $stmt->bindParam(5, 1);
// $stmt->bindParam(6, $final);

// $stmt->execute();
?>