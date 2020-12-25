<?php 
include('connect.php');
$Subject_Id=2005;
$ExamTerm =1;
$AcademicStartYear=2020;
$AcademicEndYear=2021;
$Question_Id = 1;


// $stmt = $conn->prepare("CALL xemDanhSachSinhVien(2005, 1, 2020, 2021)");
$stmt = $conn->prepare("call xemSoSinhVienLamDungi7($Question_Id, $Subject_Id,$ExamTerm, $AcademicStartYear, $AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $stmt->fetch()) {
        echo $stmt->fetch();
    }
   
