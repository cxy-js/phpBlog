<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(!$_SESSION){
	echo "无权访问！";
	exit();
}
include '../../public/dsn.config.php';
$username=$_POST['uname'];
$pwd=$_POST['password'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
//注册用户sql
$sql = "insert into user(username,password,isadmin) values('{$username}','{$pwd}',0)";
//插入前查看数据库中是否同名
$selectsql="select username from user where username='{$username}'";
$smt = $pdo->query($selectsql);
$row=$smt->fetch(PDO::FETCH_ASSOC);
//判断是否重名
if($row['username']==$username){
	echo "用户已存在";
	echo "<script>setTimeout(function(){location='../../admin.php'},2000)</script>";
	exit();
}else{
	//不同名执行sql,插入
	$pdo->exec($sql);

	echo "<script>location='../../admin.php'</script>";
}
?>