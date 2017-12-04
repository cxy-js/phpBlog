<?php

header("content-type:text/html;charset=utf-8");
session_start();
include '../../public/dsn.config.php';
// $username=$_POST['uname'];
$pwd=$_POST['password'];
$isadmin=$_POST['isadmin'];
$uid=$_POST['uid'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
$selectsql="select password from user where id='{$uid}'";
//修改用户sql
$sql = "update user set password='{$pwd}',isadmin='{$isadmin}' where id='{$uid}'";
$smt=$pdo->query($selectsql);
$row=$smt->fetch();
if($row['password']===$pwd){
	echo "fail";
	exit();
}
if($pdo->exec($sql)){
	$_SESSION['isadmin']=$isadmin;
	echo "success";
}
?>