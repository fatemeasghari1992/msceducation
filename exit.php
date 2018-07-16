<?php

setcookie("session", '', time()+3600, "/","", 0);
setcookie("studentNumber", '', time()+3600, "/","", 0);
header("location: http://127.0.0.1:8083/index.php ");