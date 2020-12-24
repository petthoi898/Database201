<?php include('connect.php'); 
session_start();
if(isset($_SESSION['id'])) header('Location: home.php');
?>
<?php

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<?php
$msg = '';
if (isset($_POST['submit'])) {
    echo '<script type="text/javascript">$(".box").show()</script>';
    $id = $_POST['id'];
    $password = $_POST['password'];

    if ($id != "" && $password != "") {
        $id = intval($id);
        try {
            $sql = "select * from `student` where `ID`=:id and `PASSWORD`=:password";

            $stmt = $conn->prepare($sql);


            $stmt->bindParam('id', $id);
            $stmt->bindParam('password', $password);

            $stmt->execute();


            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($count == 1 && !empty($row)) {
                /******************** Your code ***********************/
                

                $_SESSION['level'] = 1;
                $_SESSION['name'] = $row['FNAME'];
                header('Location: home.php');
            } else {
                $id = $_POST['id'];
                $sql2 = "select * from `employee` where `IDPASSWORD`=:id and `PASSWORD`=:password";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam('id', $id);
                $stmt2->bindParam('password', $password);
                $stmt2->execute();
                $count2 = $stmt2->rowCount();
                $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ($count2 == 1 && !empty($row2)) {

                    $_SESSION['level'] = 2;
                    $_SESSION['name'] = $row2['FNAME'];
                    // echo $_SESSION['name'] ;
                    // echo $_SESSION['level'] = 2;
                    header('Location:home.php');
                } else {
                    $msg = "Invalid username and password!";
                }
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css"> -->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" method="post">
                        <h1>Login</h1>
                        <p class="text-muted"> Please enter your login and password!</p>
                        <input type="text" name="id" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <a class="forgot text-muted" href="#">Forgot password?</a>
                        <input type="submit" name="submit" value="Login" href="#">
                        <span class="loginMsg"><?php echo @$msg; ?></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>