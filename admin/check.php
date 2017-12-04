<?php
header("content-type:text/html;charset=utf-8");
include '../public/dsn.config.php';
$pdo = new PDO(DSN,ROOT,PASSWORD);
//查询按时间从大到小排序
$sql="select * from article order by addtime desc";
$smt=$pdo->query($sql);
$rows=$smt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);
?>