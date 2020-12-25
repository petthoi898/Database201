<?php session_start();
include('../connect.php');
if (!isset($_SESSION['name'])) {
    header('Location: /vscode/home.php');
}
?>

<?php if ($_SESSION['level'] == 1) {
    echo "<h1?>THIS IS ACCOUNT STUDENT</h1>";
} else echo "<h1?>THIS IS ACCOUNT TEACHER</h1>";
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
    <style>
        body {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-4">
            <form action="" method="post" style="margin:50px">
            <button class="btn btn-primary" name="insert_question" style="margin: 10px auto;">Thêm câu hỏi cho môn học</button>
            </form>
        </div>
        <div class="col-8">
            
        </div>

    </div>

    <script>
        
    </script>
    

</body>

</html>