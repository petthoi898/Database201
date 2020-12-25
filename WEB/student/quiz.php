<?php 
include('../header.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('../connect.php');
include('../control.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="/vscode/css/header.css">
    <style>
        .detail{
            
            border-left: 1px solid rgb(137, 137, 137);
        }
        button.btn{
            width: 90%;
        }
    </style>
</head>

<body>
    <?php 
    $Subject_id = 2005;
    $ExamTerm = 1;
    $AcademicStartYear = 2020;
    $AcademicEndYear = 2021;
    $Question_Id = 1;
    
    $stmt = $conn->prepare("call xemDeThi1MonHoc($Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear)");
    $stmt->execute();
    // set the resulting array to associative
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    while ($row = $stmt->fetch()) {
       
        if($row['INDEX_'] ==1 )echo  $row['QUESTION_ID'].". " .$row['QUESTIONTEXT'] . "<br>";

        if($row['INDEX_'] == 1){
            echo "<p style = 'padding-left: 40px'>A. " .$row['ANSWERTEXT']."</p>";
        }else if($row['INDEX_'] == 2){
            echo "<p style = 'padding-left: 40px'>B. " .$row['ANSWERTEXT']."</p>";
        }else if($row['INDEX_'] == 3){
            echo "<p style = 'padding-left: 40px'>C. " .$row['ANSWERTEXT']."</p>";
        }else if($row['INDEX_'] == 4){
            echo "<p style = 'padding-left: 40px'>D. " .$row['ANSWERTEXT']."</p>";
        }
        
        
    }
    
    
    ?>
    <ol type="1">
        <?php while ($row = $stmt->fetch()) { ?>
            <li>
                
            </li>
            <?php }?>
    </ol>

    <?php
    include('../footer.php');
   

    ?>

</body>

</html>