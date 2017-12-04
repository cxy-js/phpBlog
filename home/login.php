<?php
header("content-type:text/html;charset=utf-8");
session_start();
include '../public/dsn.config.php';
$username=$_POST['uname'];
$pwd=$_POST['password'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
$sql = "select id,username,isadmin from user where username='{$username}' and password='{$pwd}'";// and isadmin=1 管理员登录
$smt = $pdo->prepare($sql);
$smt->execute();
$rows= $smt->fetch();

if($rows){
	$_SESSION['username']=$rows['username'];
	$_SESSION['isadmin']=$rows['isadmin'];
	$_SESSION['id']=$rows['id'];
	echo "<script>location='../index.php'</script>";

}else{
	echo "登陆失败";
	echo $rows['isadmin'];
	echo "<script>setTimeout(function(){location='../index.php'},2000)</script>";

}
?>