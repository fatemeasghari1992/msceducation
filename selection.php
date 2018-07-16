<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?
require_once('main.php');
$CourseId = $_POST['CourseId'];
$session = $_COOKIE["session"];
$studentNumber = $_COOKIE["studentNumber"];
if(authenticate($studentNumber,$session)){
    $db = Db::getInstance();
    $record = $db->first("SELECT Capacity,Name,Number FROM Courses WHERE ID='$CourseId'");
    $isReserved = $db->first("SELECT Number FROM student_courses WHERE courseId='$CourseId'");
    echo "<div style='text-align: center'>";
    if ($record == null){
        $message = "درسی با این شماره وجود ندارد";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-warning'>بازگشت به صفحه انتخاب درس</a>";
        exit;
    } else if(!$record['Capacity'] >= 1){
        $message = "ظرفیت این درس تکمیل است";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-warning'>بازگشت به صفحه انتخاب درس</a>";
        exit;
    }else if(isset($isReserved)) {
        $message = "این درس قبلا اخذ شده است";
        require_once("succeed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-danger'>بازگشت به صفحه انتخاب درس</a>";
        exit;
    }else{
            $Number = $record['Number'];
            $Name = $record['Name'];
            $reserved = $db->insert("INSERT INTO student_courses (courseId,studentNumber,Name,Number) values ('$CourseId','$studentNumber','$Name','$Number')");
            $capacity = $record['Capacity'] -1;
            $capacityInsertion = $db->query("UPDATE Courses SET Capacity='$capacity' WHERE Number='$Number'");
            $message = "درس شما با موفقیت ثبت شد";
            require_once("succeed.php");
            br();
            br();
            br();
            echo "<a href='index.php' class='btn btn-warning'>بازگشت به صفحه انتخاب درس</a>";
            exit;
        }
    echo "</div>";
}else{
    $message = "شماره دانشجویی شما ثبت نشده است.لطفا به صفحه ورود مراجعه نمایید";
    require_once("failed.php");
    br();
    br();
    br();
    echo "<a href='http://127.0.0.1:8083/index.php' class='btn btn-info'>بازگشت به صفحه ورود</a>";
    exit;
}
?>
</body>
</html>

