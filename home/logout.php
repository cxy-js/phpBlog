<?php
header("content-type:text/html;charset=utf-8");
session_start();
$_SESSION=array();
setcookie(PHPSESSID,'',time()-1,'/');
session_destroy();
echo "<script>location='../index.php'</script>";
?>