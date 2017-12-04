<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(!$_SESSION){
	echo "无权访问！";
	exit();
}

include '../../public/dsn.config.php';
$pdo = new PDO(DSN,ROOT,PASSWORD);
$title = $_POST['title'];
$content = $_POST['content'];
$autho = $_SESSION['username'];
$sql = "insert into article(title,content,addtime,autho) values('{$title}','{$content}',now(),'{$autho}')";
if($pdo->exec($sql)){
	echo "<script>location='../../admin.php'</script>";
}else{
	echo "sorry";
}

?>