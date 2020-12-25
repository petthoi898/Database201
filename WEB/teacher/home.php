<?php 
include('../header.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('../connect.php');
include('../control.php');

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
        button.btn{
            width: 90%;
        }
    </style>
</head>

<body>
    <div class="row" style="height: 700px; ">
        <div class="col-3 func">
            <form action="" method="post" style="margin:25px">
                <button class="btn btn-primary" name="insert_question" style="margin: 10px auto;">Thêm câu hỏi cho môn học</button>
                <button class="btn btn-primary" name="show_list_student" style="margin: 10px auto;">Danh sách sinh viên</button>
                <button class="btn btn-primary" name="show_scores_student" style="margin: 10px auto;">Xem điểm sinh viên</button>
                <button class="btn btn-primary" name="show_correct_student" style="margin: 10px auto;">Xem số sinh viên làm đúng</button>
                <button class="btn btn-primary" name="show_result_student" style="margin: 10px auto;">Xem kết quả của sinh viên</button>
                <button class="btn btn-primary" name="show_rate_correct_student" style="margin: 10px auto;">Xem 5 câu làm sai nhiều nhất</button>
            </form>
        </div>
        <div class="col-9 detail">


            <?php if ($_SESSION['level'] == 1) {
                echo "<h1?>THIS IS ACCOUNT STUDENT</h1>";
            } else echo "<h1?>THIS IS ACCOUNT TEACHER</h1>";
            ?>

            <?php
            if (isset($_POST['submit_insert_question'])) {
                echo '<script type="text/javascript">$("form[name = insert_question]").show()</script>';
                $QUESID = intval($_POST['QUESID']);
                $QUESTEXT = $_POST['QUESTEXT'];
                $QUESCONTENT = $_POST['QUESCONTENT'];
                $QUESSUBJECTID = intval($_POST['QUESSUBJECTID']);
                $QUESINCSSN = $_POST['QUESINCSSN'];
                $QUESDATEUPLOAD = date("Y-m-d");
                $QUESDESCCONTID = intval($_POST['QUESDESCCONTID']);
                $ANSINDEX_ = intval($_POST['ANSINDEX_']);
                $ANSANSWERTEXT = $_POST['ANSANSWERTEXT'];
                $ANSCORRECTNESS = intval($_POST['ANSCORRECTNESS']);
                $ANSDESCONTID = intval($_POST['ANSDESCONTID']);
                $GENERALID = intval($_POST['GENERALID']);
                $GENERALDESCONID = intval($_POST['GENERALDESCONID']);
                $GENERALDESCRIPTIONTEXT = $_POST['GENERALDESCRIPTIONTEXT'];
                $FID = intval($_POST['FID']);
                $FFILESOURCE = $_POST['FFILESOURCE'];
                $FFILE = $_POST['FFILE'];

                try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("call capNhatCauHoi($QUESID,$QUESTEXT,$QUESCONTENT,$QUESSUBJECTID,
            $QUESINCSSN,$QUESDATEUPLOAD,$ANSINDEX_,$ANSANSWERTEXT,$ANSCORRECTNESS,$ANSDESCONTID,
            $GENERALID,$GENERALDESCONID,$GENERALDESCRIPTIONTEXT,$FID,$FFILESOURCE,$FFILE)");

                    $stmt->execute();
                    echo "New record created successfully";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    echo "New record created failed";
                }
            }
            ?>

            <form action="" name="form_insert_question" method="post">
                <div class="row add" style="width:90%">
                    <div class="form-group col-4">
                        <label for="">QUESID:</label>
                        <input type="text" class="form-control" name="QUESID" id="QUESID" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">QUESTEXT:</label>
                        <input type="text" class="form-control" name="QUESTEXT" id="QUESTEXT" aria-describedby="helpId" placeholder="">
                        <small id="helpName" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">QUESCONTENT:</label>
                        <input type="text" class="form-control" name="QUESCONTENT" id="QUESCONTENT" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">QUESSUBJECTID:</label>
                        <input type="text" class="form-control" name="QUESSUBJECTID" id="QUESSUBJECTID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">QUESINCSSN:</label>
                        <input type="text" class="form-control" name="QUESINCSSN" id="QUESINCSSN" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <!-- <div class="form-group col-4">
                    <label for="">QUESDATEUPLOAD:</label>
                    <input type="text" class="form-control" name="QUESDATEUPLOAD" id="QUESDATEUPLOAD" aria-describedby="emailHelpId" placeholder="">
                    <small id="helpYear" class="form-text text-muted"></small>
                    </div> -->
                    <div class="form-group col-4">
                        <label for="">QUESDESCCONTID</label>
                        <input type="text" class="form-control" name="QUESDESCCONTID" id="QUESDESCCONTID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">ANSINDEX_</label>
                        <input type="text" class="form-control" name="ANSINDEX_" id="ANSINDEX_" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">ANSANSWERTEXT</label>
                        <input type="text" class="form-control" name="ANSANSWERTEXT" id="ANSANSWERTEXT" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">ANSCORRECTNESS:</label>
                        <input type="text" class="form-control" name="ANSCORRECTNESS" id="ANSCORRECTNESS" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">ANSDESCONTID:</label>
                        <input type="text" class="form-control" name="ANSDESCONTID" id="ANSDESCONTID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">GENERALID</label>
                        <input type="text" class="form-control" name="GENERALID" id="GENERALID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">GENERALDESCONID</label>
                        <input type="text" class="form-control" name="GENERALDESCONID" id="GENERALDESCONID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group col-4">
                        <label for="">GENERALDESCRIPTIONTEXT</label>
                        <input type="text" class="form-control" name="GENERALDESCRIPTIONTEXT" id="GENERALDESCRIPTIONTEXT" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">FID</label>
                        <input type="text" class="form-control" name="FID" id="FID" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-4">
                        <label for="">FFILESOURCE</label>
                        <input type="text" class="form-control" name="FFILESOURCE" id="FFILESOURCE" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group col-4">
                        <label for="">FFILE</label>
                        <input type="text" class="form-control" name="FFILE" id="FFILE" aria-describedby="emailHelpId" placeholder="">
                        <small id="helpYear" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-12">
                        <button name="submit_insert_question">Submit</button>
                    </div>
                </div>

            </form>
            <?php
            if (isset($_POST['submit_show_list_student'])) {
                echo '<script type="text/javascript">$("form[name = form_show_list_student]").show()</script>';
                $Subject_id = intval($_POST['Subject_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showListStudent($conn, $Subject_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear);
            }
            ?>

            <form action="" name="form_show_list_student" method="post">
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
                    <button name="submit_show_list_student">Submit</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit_show_scores_student'])) {
                echo '<script type="text/javascript">$("form[name = form_show_scores_student]").show()</script>';
                $student_id = intval($_POST['student_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showScoresStudent($conn, $student_id, $ExamTerm, $AcademicStartYear, $AcademicEndYear);
            }
            ?>

            <form action="" name="form_show_scores_student" method="post">
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
            </form>

            
             <?php
            if (isset($_POST['submit_show_correct_student'])) {
                echo '<script type="text/javascript">$("form[name = form_show_result_student]").show()</script>';
                $Question_Id = intval($_POST['Question_Id']);
                $Subject_Id = intval($_POST['Subject_Id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showCorrectStudents($conn, $Question_Id, $Subject_Id, $ExamTerm, $AcademicStartYear, $AcademicEndYear);
            }
            ?>

            <form action="" name="form_show_correct_student" method="post">
                <div class="form-group col-4">
                    <label for="">Question_Id:</label>
                    <input type="text" class="form-control" name="Question_Id" id="Question_Id" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-4">
                    <label for="">Subject_Id :</label>
                    <input type="text" class="form-control" name="Subject_Id" id="Subject_Id" aria-describedby="helpId" placeholder="">
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
                    <button name="submit_show_correct_student">Submit</button>
                </div>
            </form>

            <?php
            if (isset($_POST['submit_show_result_student'])) {
                echo '<script type="text/javascript">$("form[name = form_show_result_student]").show()</script>';
                $student_id = intval($_POST['student_id']);
                $Subject_id = intval($_POST['Subject_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                showResultStudent($conn, $student_id, $Subject_id,$ExamTerm, $AcademicStartYear, $AcademicEndYear);
            }
            ?>

            <form action="" name="form_show_result_student" method="post">
                <div class="form-group col-4">
                    <label for="">student_id:</label>
                    <input type="text" class="form-control" name="student_id" id="student_id" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
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
                    <button name="submit_show_result_student">Submit</button>
                </div>
            </form>


            <?php
            if (isset($_POST['submit_show_list_question_incorrect'])) {
                echo '<script type="text/javascript">$("form[name = form_show_list_student]").show()</script>';
                $Subject_Id = intval($_POST['Subject_id']);
                $ExamTerm = $_POST['ExamTerm'];
                $AcademicStartYear = $_POST['AcademicStartYear'];
                $AcademicEndYear = intval($_POST['AcademicEndYear']);
                show5IncorrectQuestion($conn, $Subject_Id, $ExamTerm, $AcademicStartYear, $AcademicEndYear);
            }
            ?>

            <form action="" name="form_show_list_question_incorrect" method="post">
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
                    <button name="submit_show_list_question_incorrect">Submit</button>
                </div>
            </form>






        </div>

    </div>

    <script>
        $("form[name = form_insert_question]").hide();
        $("form[name = form_show_list_student]").hide();
        $("form[name = form_show_scores_student]").hide();
        $("form[name = form_show_correct_student]").hide();
        $("form[name = form_show_result_student]").hide();
        $("form[name = form_show_list_question_incorrect]").hide();
    </script>
    <?php
    include('../footer.php');
    if (isset($_POST['insert_question'])) {
        echo '<script type="text/javascript">$("form[name = form_insert_question]").show()</script>';
    } else if (isset($_POST['show_list_student'])) {
        echo '<script type="text/javascript">$("form[name = form_show_list_student]").show()</script>';
    } else if (isset($_POST['show_scores_student'])) {
        echo '<script type="text/javascript">$("form[name = form_show_scores_student]").show()</script>';
    }else if (isset($_POST['show_correct_student'])) {
        echo '<script type="text/javascript">$("form[name = form_show_correct_student]").show()</script>';
    }
    else if (isset($_POST['show_result_student'])) {
        echo '<script type="text/javascript">$("form[name = form_show_result_student]").show()</script>';
    }if (isset($_POST['show_list_question_incorrect'])) {
        echo '<script type="text/javascript">$("form[name = form_show_list_question_incorrect]").show()</script>';
    }

    ?>

</body>

</html>