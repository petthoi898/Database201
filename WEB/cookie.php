<?php

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
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
        table th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        .form-control {
            width: 200px;
        }
    </style>
    <script>
        function getValue() {
            var name = $(".name").val();
            var value = $(".value").val();
            var expires = $(".expires").val();
            var path = $(".path").val();
            var domain = $(".domain").val();
            var secure = $(".secure").val();
            console.log(name + "  " + value + "  " + expires + "  " + path + "  ");
        }
        // Set cookie
        function setCookie() {

            var name = $(".name").val();
            var value = $(".value").val();
            var expires = $(".expires").val();
            var path = $(".path").val();
            var domain = $(".domain").val();
            var secure = $(".secure").val();
            document.cookie = name + "=" + escape(value) +
                ((expires == null) ? "" : "; expires=" + expires )+
                ((path == null) ? "" : "; path=" + path) +
                ((domain == null) ? "" : "; domain=" + domain) +
                ((secure == null) ? "" : "; secure");
        
        }

        // Read cookie
        function getCookie() {
            var name = $(".name").val();
            var cname = name + "=";
            var dc = document.cookie;
            if (dc.length > 0) {
                begin = dc.indexOf(cname);
                if (begin != -1) {
                    begin += cname.length;
                    end = dc.indexOf(";", begin);
                    if (end == -1) end = dc.length;
                    return unescape(dc.substring(begin, end));
                }
            }
            return null;
        }

        function get_cookies_array() {
            var cookies = {};
            if (document.cookie && document.cookie != '') {
                var split = document.cookie.split(';');
                for (var i = 0; i < split.length; i++) {
                    var name_value = split[i].split("=");
                    name_value[0] = name_value[0].replace(/^ /, '');
                    cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
                }
            }
            return cookies;

        }

        function write_all_cookie() {
            var cookies = get_cookies_array();
            for (var name in cookies) {
                document.write(name + " : " + cookies[name] + "<br />");
            }
        }

        //delete cookie
        function eraseCookie(name, path, domain) {
            if (getCookie(name)) {
                document.cookie = name + "=" +
                    ((path == null) ? "" : "; path=" + path) +
                    ((domain == null) ? "" : "; domain=" + domain) +
                    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
            }
        }
    </script>

</head>

<body>
    <form action="" method="post" style="margin:50px">
        <button class="btn btn-primary" name="select">Show all cookies</button>
        <button class="btn btn-primary" name="add">Set cookie</button>
        <button class="btn btn-primary" name="edit">Edit cookie</button>
        <button class="btn btn-primary" name="delete">Delete cookie</button>
    </form>

    <form action="" name="setCookie" method="post">
        <div class="row add" style="width:60% ; margin:50px">
            <div class="form-group col-4">
                <label for="">name</label>
                <input type="text" class="form-control name" name="name" aria-describedby="helpId" placeholder="">

            </div>
            <div class="form-group col-4">
                <label for="">value</label>
                <input type="text" class="form-control value" name="value" aria-describedby="helpId" placeholder="">

            </div>
            <div class="form-group col-4">
                <label for="">expires</label>
                <input type="text" class="form-control expires" name="expires" aria-describedby="emailHelpId" placeholder="">

            </div>
            <div class="form-group col-4">
                <label for="">path</label>
                <input type="text" class="form-control path" name="path" aria-describedby="emailHelpId" placeholder="">

            </div>
            <div class="form-group col-4">
                <label for="">domain</label>
                <input type="text" class="form-control domain" name="domain" aria-describedby="emailHelpId" placeholder="">

            </div>
            <div class="form-group col-4">
                <label for="">secure</label>
                <input type="text" class="form-control secure" name="secure" aria-describedby="emailHelpId" placeholder="">

            </div>

            <button name="add_submit" onclick="setCookie()">Submit</button>

        </div>
    </form>

    <!-- onclick="write_all_cookie()" -->


    <?php
    if (isset($_POST['select'])) {
        echo '<script type="text/javascript">write_all_cookie();</script>';
    }
    if (isset($_POST['add_submit'])) {
        echo '<script type="text/javascript">setCookie();</script>';
    }
    ?>

</body>

</html>