<?php
header("content-type:text/html;charset=utf-8");
include '../../public/dsn.config.php';
$content=$_GET['search'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
$sql="select * from article where title like '%{$content}%'";
$smt = $pdo->query($sql);
$row=$smt->fetchAll(PDO::FETCH_ASSOC);
if($row){
	echo "";
}else{
	echo "<span style='position:relative;top:100px;left:45%'>sorry!没有查到此数据！</span>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>seach</title>
	<link rel="stylesheet" href="../../public/css/seletarticle.css">
</head>
<body>
	<div class="main">
		<div class="brand">
			<a href="../../index.php">
				<img src="../../public/img/blog.png" height="50" width="160" alt="">
			</a>
			<form action="selectarticle.php" method="GET" class="searchform">
				<input type="text"  class="search-input" name="search">
				<input type="submit" value="Search" class="submit">
			</form>
		</div>
		<div style="clear:both"></div>
		<!--查到的内容-->
		<?php

		foreach($row as $r){
			echo "<div class='content'>";
			echo "<span class='title'>标题：</span><h4>{$r['title']}</h4>";
			echo "<span class='searchcontent'>{$r['content']}</span>";
			echo "</div>";
		}
		?>

	</div>
</body>
</html>