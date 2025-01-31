<?php 
include('../header.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('../connect.php');
include('../control.php');
// $id = $_SESSION['ID'];
?>
<a href="http://"></a>
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
        button.btn ,a.btn{
            width: 90%;
        }
    </style>
</head>

<body>
    <div class="row" style="padding-bottom:50px">
        <div class="col-3 func">
            <form action="" method="post" style="margin:25px">
            <button class="btn btn-primary" name="show_exam" style="margin: 10px auto;">Xem đề thi môn học</button>
            <button class="btn btn-primary" name="show_answer" style="margin: 10px auto;">Xem đáp án đề thi</button>    
            <a class="btn btn-primary" href="quiz.php" style="text-align: center; font-size: large;">Làm Quiz</a>
            </form>
        </div>
        <div class="col-9 detail">

            

            <?php
            if (isset($_POST['submit_show_exam'])) {
                echo '<script type="text/javascript">$("form[name = form_show_exam]").show()</script>';
                $Subject_id = intval($_POST['Subject_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showExam($conn, $Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear );
            }
            ?>

            <form action="" name="form_show_exam" method="post">
                <div class="form-group col-4">
                    <label for="">Subject_id:</label>
                    <input type="text" class="form-control" name="Subject_id" id="Subject_id" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">ExamTerm:</label>
                    <input type="text" class="form-control" name="ExamTerm" id="ExamTerm" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicStartYear:</label>
                    <input type="text" class="form-control" name="AcademicStartYear" id="AcademicStartYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicEndYear:</label>
                    <input type="text" class="form-control" name="AcademicEndYear" id="AcademicEndYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-12">
                    <button name="submit_show_exam">Submit</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit_show_answer'])) {
                echo '<script type="text/javascript">$("form[name = form_show_answer]").show()</script>';
                $Subject_id = intval($_POST['Subject_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showAnswer($conn, $Subject_id,$ExamTerm ,$AcademicStartYear ,$AcademicEndYear );
            }
            ?>

            <form action="" name="form_show_answer" method="post">
                <div class="form-group col-4">
                    <label for="">Subject_id:</label>
                    <input type="text" class="form-control" name="Subject_id" id="Subject_id" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">ExamTerm:</label>
                    <input type="text" class="form-control" name="ExamTerm" id="ExamTerm" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicStartYear:</label>
                    <input type="text" class="form-control" name="AcademicStartYear" id="AcademicStartYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicEndYear:</label>
                    <input type="text" class="form-control" name="AcademicEndYear" id="AcademicEndYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-12">
                    <button name="submit_show_answer">Submit</button>
                </div>
            </form>

            <?php
            // if (isset($_POST['submit_show_scores_student'])) {
            //     echo '<script type="text/javascript">$("form[name = form_show_scores_student]").show()</script>';
            //     $student_id = intval($_POST['student_id']);
            //     $ExamTerm = $_POST['ExamTerm'];
            //     $AcademicStartYear = $_POST['AcademicStartYear'];
            //     $AcademicEndYear = intval($_POST['AcademicEndYear']);
            //     showScoresStudent($conn, $student_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear);
            // }
            ?>

            <!-- <form action="" name="form_show_scores_student" method="post">
                <div class="form-group col-4">
                    <label for="">student_id:</label>
                    <input type="text" class="form-control" name="student_id" id="student_id" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">ExamTerm:</label>
                    <input type="text" class="form-control" name="ExamTerm" id="ExamTerm" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicStartYear:</label>
                    <input type="text" class="form-control" name="AcademicStartYear" id="AcademicStartYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">AcademicEndYear:</label>
                    <input type="text" class="form-control" name="AcademicEndYear" id="AcademicEndYear" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-12">
                    <button name="submit_show_scores_student">Submit</button>
                </div>
            </form> -->
        </div>

    </div>

    <script>
        
        $("form[name = form_show_exam]").hide();
        $("form[name = form_show_answer]").hide();
        
    </script>
    <?php
    include('../footer.php');
     if (isset($_POST['show_exam'])) {
        echo '<script type="text/javascript">$("form[name = form_show_exam]").show()</script>';
    }else if (isset($_POST['show_answer'])) {
        echo '<script type="text/javascript">$("form[name = form_show_answer]").show()</script>';
    }

    ?>

</body>

</html>