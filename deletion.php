<?php
require_once('main.php');
$courseId = $_POST['CourseId'];
$session = $_COOKIE["session"];
$studentNumber = $_COOKIE["studentNumber"];
$db = Db::getInstance();
if(authenticate($studentNumber,$session)) {

    $record = $db->first("SELECT ID FROM student_courses WHERE courseId='$courseId'");
    echo "<div style='text-align: center'>";
    if ($record == null){
        $message = "درسی با این شماره برای شما اخذ نشده است";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='selected.php'>بازگشت </a>";
        exit;
    } else {

        $record = $db->query("DELETE FROM student_courses WHERE courseId='$courseId'");
        $record = $db->first("SELECT Capacity FROM Courses WHERE ID='$courseId'");
        $capacity = $record['Capacity'] + 1;
        $capacityInsertion = $db->query("UPDATE Courses SET Capacity='$capacity' WHERE ID='$courseId'");
        $message = "درس شما با موفقیت حذف شد";
        require_once("succeed.php");
        br();
        br();
        br();
        echo "<a href='selected.php'>بازگشت </a>";
    }
}else{
    $message = "شماره دانشجویی شما ثبت نشده است.لطفا به صفحه ورود مراجعه نمایید";
    require_once("failed.php");
    br();
    br();
    br();
    echo "<a href='http://127.0.0.1:8083/index.php'>بازگشت به صفحه انتخاب درس</a>";
    exit;
}