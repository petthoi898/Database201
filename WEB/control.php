<?php

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<!-- get data -->
<?php

function select($conn)
{
    $stmt = $conn->prepare("SELECT id, name, year FROM cars");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>Id</th><th>Name</th><th>Year</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['name'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['year'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php
function add($conn, $id, $name, $year)
{
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO cars (id, name, year) VALUES (:id, :name, :year)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "New record created failed";
    }
}
?>

<?php
function delete($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM cars WHERE id =:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if (!$stmt->rowCount()) echo "Deletion failed!";
    else echo "Deletion success!";
}
?>

<?php
function update($conn, $id, $name)
{
    $stmt = $conn->prepare("UPDATE cars SET `name` = :name WHERE `id` = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    if (!$stmt->rowCount()) echo "Update failed!";
    else echo "Update success!";
}
?>

<?php
function checkName($name)
{
    if (strlen($name) < 5 || strlen($name) > 40) return false;
    else return true;
}
function checkYear($year)
{
    if ($year > 1990 && $year < 2015) return true;
    else return false;
}
?>

<?php
function showListStudent($conn, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<table style='border: solid 1px black; margin-left:50px'>";
    echo "<tr><th>Id</th><th>FNAME</th><th>MNAME</th><th>LNAME</th><th>GENDER</th><th>BIRTHDAY</th><th>EMAIL</th><th>ADDRESS</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['ID'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['FNAME'] . "</td>";
        echo "<td style='width: 150px; border: 1px solid black;'>" . $row['MNAME'] . "</td>";
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
function showResultStudent($conn, $student_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear)
{
    $stmt = $conn->prepare("call xemKetQuaBaiLamSinhVien($student_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
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
    $stmt = $conn->prepare("call xemSoSinhVienLamDungi7($Question_Id, $Subject_Id,$ExamTerm, $AcademicStartYear, $AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {
        echo $stmt->fetch();
    }
}
?>

