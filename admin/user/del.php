<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(!$_SESSION){
	echo "无权访问！";
	exit();
}

include '../../public/dsn.config.php';
$pdo = new PDO(DSN,ROOT,PASSWORD);
//删除用户
$id=$_GET['id'];
$sql="delete from user where id='{$id}'";
$r=$pdo->exec($sql);
if($r){
    echo "1";
}else{
    echo "0";
}
?>