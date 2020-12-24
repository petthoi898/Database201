
<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/vscode/css/header.css">

    

</head>


<body>
    <div class="header">
        <div class="container row">
            <div class="logo col-md-6">
                <a href="home.php"><img src="/vscode/images/logo.png" alt=""></a>

            </div>
            <div class="login col-md-6" style="margin:auto">
                
                <p class = "yet">Bạn chưa đăng nhập (<span><a href="/vscode/login.php" style="color:blue;font-weight: bold;font-style: italic;">Đăng nhập</a></span>)</p>
                <p class="not-yet">Xin chào <span style="font-size: larger; color:beige"><?php echo $_SESSION['name']?> </span> (<span><a href="/vscode/login.php" style="color:darkturquoise;font-weight: bold;font-style: italic;">Đăng xuất</a></span>)</p>
  
            </div>
        </div>
        <nav class="navbar navbar-expand-sm navbar-light bg-transparent">
            <button class="navbar-toggler d-lg-none mr-auto ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId" >
                <ul class="navbar-nav mr-auto row " style="width: 100%;">
                    <li class="nav-item col-md-3 v-divider ">
                        <a class="nav-link" href="/vscode/home.php">TRANG CHỦ</a>
                    </li>
                    
                    
                    <li class="nav-item col-md-3 v-divider ">
                        <a class="nav-link" href="/vscode/mypage.php">TRANG CỦA TÔI</a>
                    </li>
                    
                    
                    <li class="nav-item col-md-3 v-divider">
                        <a class="nav-link" href="#">BÀI GIẢNG</a>
                    </li>
                    
                    <li class="nav-item col-md-3">
                        <a class="nav-link" href="#">HỒ SƠ</a>
                    </li>
                </ul>

            </div>
        </nav>
        
    </div>
</body>

</html>

<?php 

if (!isset($_SESSION['name'])) {
    header('Location: /vscode/home.php');
}
// $newUrl ='href="/vscode/logout.php"';
if(isset($_SESSION['name'])){
    // echo '<script type="text/javascript">$("div.login").html("<a ='.$newUrl.' >Đăng xuất</a>")</script>';
    // echo '<script type="text/javascript">$("div.login >a ").attr("logout.php")</script>';
    echo '<script type="text/javascript">$(".yet").hide()</script>';
    // echo '<script type="text/javascript">$(".not-yet").hide()</script>';
    // echo $_SESSION['name'];
    
}else{
    echo '<script type="text/javascript">$(".not-yet").hide()</script>';
}
?>