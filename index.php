


<!DOCTYPE html>
<html lang="en">
<head>
    <title>education</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php
require_once('main.php');
?>
<br>
<a href="exit.php" class="btn btn-danger col-md-offset-11">خروج</a>
<br><br>
<div class="container">
    <div class="row">

        <div class="row">

            <div class="col-sm-12 col-md-11">

                <div class="thumbnail shadow-depth">

                    <div class="caption">
                        <table class="table table-striped">
                            <thead class="alert alert-info">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Unite</th>
                                <th>Capacity</th>
                            </tr>
                            </thead>

                            <?
                            $db = Db::getInstance();
                            $record = $db->query("SELECT ID,Name,Unite,Capacity FROM Courses");
                            foreach ($record as $item){
                                echo "<tr class='table-row'>";
                                foreach ($item as $key => $value){
                                    echo "<td>";
                                    echo $value;
                                    echo "</td>";
                                }
                            }
                            ?>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="pad15"><br>
                <div class="md-input">
                    <form action="selection.php" method="post" >
                        <input class="md-form-control" required="" type="text" name="CourseId">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره درس خود را وارد کنید</label>
                </div>

                <button type="submit"  class="btn btn-info">اخذ درس</button>
                </form>


            </div>
        </div>
        <br><br><br><br><br>
        <div class="col-md-2 col-md-offset-1">
            <a href="http://127.0.0.1:8083/menu.php" class="btn btn-warning">بازگشت به صفحه خدمات</a>


        </div>

        <div class="col-md-2 col-md-offset-1">


            <a href="selected.php" class="btn btn-success">دروس اخذ شده</a>
        </div>

    </div>


</body>
</html>