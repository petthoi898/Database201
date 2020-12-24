<?php
include 'connect.php';
include 'control.php';
?>
<!DOCTYPE html>
<html lang="vi">

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
        $("div.add").hide();
        $("div.update").hide();
        $("div.dell").hide();
    </script>
</head>

<body>

    <!-- <div class="btn-group btn-group-lg" style="width: 60%; margin: 50px"> -->
    <form action="" method="post" style="margin:50px">
        <button class="btn btn-primary" name="select">Show all cars</button>
        <button class="btn btn-primary" name="add" >Add cars</button>
        <button class="btn btn-primary" name="edit" >Edit cars information</button>
        <button class="btn btn-primary" name="delete" >Delete cars</button>
    </form>

    <!-- </div> -->
    <form style="margin-left: 50px;" method="POST">
        <div class="select" id="select">
            <?php
            if (isset($_POST['select'])) {
                select($conn);
            }
            ?>
        </div>
        <div class="row add" style="width:60%">
            <div class="form-group col-4">
                <label for="">ID:</label>
                <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-4">
                <label for="">Name:</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                <small id="helpName" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-4">
                <label for="">year</label>
                <input type="text" class="form-control" name="year" id="year" aria-describedby="emailHelpId" placeholder="">
                <small id="helpYear" class="form-text text-muted"></small>
            </div>
            <button name="submit" s>Submit</button>
        </div>

        <div class="del" style="width:60%">
            <div class="form-group col-4">
                <label for="">ID:</label>
                <input type="text" class="form-control" name="del_id" id="id" aria-describedby="helpId" placeholder="">
                <small id="delId" class="form-text text-muted"></small>
            </div>

            <button name="del_submit">Submit</button>
        </div>



        <div class="row update" style="width:60%">
            <div class="form-group col-6">
                <label for="">ID:</label>
                <input type="text" class="form-control" name="update_id" id="id" aria-describedby="helpId" placeholder="">
                <small id="updateId" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-6">
                <label for="">Name change:</label>
                <input type="text" class="form-control" name="new_name" id="name" aria-describedby="helpId" placeholder="">
                <small id="updateName" class="form-text text-muted"></small>
            </div>
            <button name="update_submit">Submit</button>
        </div>
    </form>

    <script>
        $("div.add").hide();
        $("div.update").hide();
        $("div.del").hide();
    </script>
    <?php
    if (isset($_POST['add'])) {
        echo '<script type="text/javascript">$("div.add").show()</script>';
    } else if (isset($_POST['edit'])) {
        echo '<script type="text/javascript">$("div.update").show()</script>';
    } else if (isset($_POST['delete'])) {
        echo '<script type="text/javascript">$("div.del").show()</script>';
    }

    ?>
    <div>
        <?php
        $id = $year = 0;
        $name_col = '';
        if (isset($_POST['submit'])) {
            echo '<script type="text/javascript">$("div.add").show()</script>';
            // phpAlert("da");
            $name_col = isset($_POST['name']) ? $_POST['name'] : '';
            $year = isset($_POST['year']) ? $_POST['year'] : '';
            $id = (isset($_POST['id'])) ? ($_POST['id']) : '';

            if (!checkName($name_col)) {
                echo '<script type="text/javascript">$("#helpName").text("Name from 5 to 40 characters")</script>';
                echo "New record created failed";
            } else if (!(checkYear(intval($year)) && is_numeric($year))) {
                echo '<script type="text/javascript">$("#helpYear").text("Name from 1990 to 2015")</script>';
                echo "New record created failed";
            } else if ($id != intval($id)) {
                echo '<script type="text/javascript">$("#helpID").text("ID is integer")</script>';
                echo "New record created failed";
            } else {
                $id = intval($id);
                add($conn, $id, $name_col, $year);
            }
        }
        ?>
    </div>
    <?php
    $id = '';
    $name = '';
    if (isset($_POST['update_submit'])) {
        echo '<script type="text/javascript">$("div.update").show()</script>';
        $name = isset($_POST['new_name']) ? $_POST['new_name'] : '';
        $id = isset($_POST['update_id']) ? ($_POST['update_id']) : '';
        if (!checkName($name)) {
            echo '<script type="text/javascript">$("#updateName").text("Name from 5 to 40 characters")</script>';
            echo "Update failed";
        } else if ($id != intval($id)) {
            echo '<script type="text/javascript">$("#updateId").text("ID is integer")</script>';
            echo "Update failed";
        } else {
            $id = intval($id);
            update($conn, $id, $name);
        }
    }
    ?>

    <?php
    $id = 0;
    if (isset($_POST['del_submit'])) {
        echo '<script type="text/javascript">$("div.del").show()</script>';
        if (isset($_POST['del_id']) && is_numeric($_POST['del_id']) && $_POST['del_id'] > 0) {
            $id =  ($_POST['del_id']);
            if ($id != intval($id)) {
                echo '<script type="text/javascript">$("#updateId").text("ID is integer")</script>';
                echo "Update failed";
            } else {
                $id = intval($id);
                delete($conn, $id);
            }
        }
    }
    ?>
</body>

</html>