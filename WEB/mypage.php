<?php session_start()?>
<?php if(!isset($_SESSION['name'])) header('Location: login.php');
if($_SESSION['level'] ==1){
    header('Location: student/home.php');
}else{
    header('Location: teacher/home.php');
}