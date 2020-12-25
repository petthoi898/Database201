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
function showResultStudent($conn, $student_id,$Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
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
    $stmt = $conn->prepare("call xemSoSinhVienLamDungi8($Subject_Id)");
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

