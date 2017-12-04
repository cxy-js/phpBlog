<?php
session_start();
header("content-type:text/html;charset=utf-8");
include '../public/dsn.config.php';
$username=$_POST['uname'];
$pwd=$_POST['password'];
$isadmin=$_POST['isadmin'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
//注册用户sql
$sql = "insert into user(username,password,isadmin) values('{$username}','{$pwd}','0')";
//插入前查看数据库中是否同名
$selectsql="select username,isadmin from user where username='{$username}'";
$pdo->exec("set names utf8");
$smt = $pdo->query($selectsql);
$row=$smt->fetch(PDO::FETCH_ASSOC);
//判断是否重名
if($row['isadmin']==$username){
	echo "用户已存在";
	echo "<script>setTimeout(function(){location='../index.php'},2000)</script>";
	exit();
}
if($row['isadmin']=='1'){
	echo "无权注册此用户";
	echo "<script>setTimeout(function(){location='../index.php'},2000)</script>";
	exit();
}
if($pdo->exec($sql)){
	//不同名执行sql,插入
	$_SESSION['username']=$username;
	$_SESSION['isadmin']=$isadmin;
	echo "<script>location='../index.php'</script>";
}

?>