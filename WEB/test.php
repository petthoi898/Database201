<?php 
include('connect.php');
$Subject_id=2005;
$ExamTerm =1;
$AcademicStartYear=2020;
$AcademicEndYear=2021;


// $stmt = $conn->prepare("CALL xemDanhSachSinhVien(2005, 1, 2020, 2021)");
$stmt = $conn->prepare("call `xemDanhSachSinhVien`($Subject_id,$ExamTerm,$AcademicStartYear,$AcademicEndYear)");
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
   
