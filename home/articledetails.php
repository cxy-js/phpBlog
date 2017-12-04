<?php
header("content-type:text/html;charset=utf-8");
include '../public/dsn.config.php';
$articleid = $_GET['id'];
$pdo = new PDO(DSN,ROOT,PASSWORD);
$sql = "select * from article where id='{$articleid}'";
$smt = $pdo->query($sql);
$row = $smt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang=" en">
<head>
	<meta charset="UTF-8">
	<title>articleone</title>
	<link rel="stylesheet" href="../public/css/index.css">
	<style>
		html,body{
			background:#fff!important;
		}
		.login,.register{
			background: #000;
		}
	</style>
</head>
<body>
	<!--头部-->
	<div class="main">
		<header class="head">
			<div class="brand"><a href="../index.php"><img src="../public/img/blog.png" height="50" width="160" alt=""></a></div>
			<form action="../admin/select/selectarticle.php" method="GET" class="searchform">
				<input type="text"  class="search-input" name="search">
				<input type="submit" value="Search" class="submit">
			</form>
			<div class="head-right" id="head-log">
				<span id="i-login">登录</span>
				<span id="i-register">注册</span>
			</div>
			<!--后台管理入口-->
			<div class="head-admin">
				<span><?php
					session_start();
					if($_SESSION['username']){
						echo "<a>欢迎&nbsp;&nbsp;&nbsp;</a>";
						echo $_SESSION['username'];
						echo "<script>document.getElementById('head-log').style.display='none'</script>";
					}
					?>
				</span>
				<!--区分是会员还是管理员-->
				<?php
				session_start();
				//管理员
				if($_SESSION['isadmin']=='1'){
					echo "<a href='../admin.php' id='admin'>";
					echo "后台管理";
					echo "</a>";

				}elseif($_SESSION['isadmin']=='0'){
					//会员
					echo "<a href='../admin/user/user.php' id='member'>";
					echo "个人中心";
					echo "</a>";
				}

				?>
				
				<a href="logout.php" id="geout"><?php
					session_start();
					if($_SESSION['username']){
						echo "退出";
						
					}
					?>
				</a>		
			</div>
			<!--登陆弹框-->
			<div class="login">
				<h4>用户登陆</h4>
				<form action="login.php" method="post">
					<input type="text" class="search-input" name="uname" required placeholder="username">
					<input type="password" class="search-input" name="password" required  placeholder="password">
					<input type="submit" value="登陆" class="submit">
				</form>
			</div>
			<!--注册弹框-->
			<div class="register">
				<h4>用户注册</h4>
				<form action="register.php" method="post">
					<input type="text" class="search-input" name="uname" required placeholder="username">
					<input type="password" class="search-input" name="password" required  placeholder="password">
					<input type="hidden" value="0" name="isadmin">
					<input type="submit" value="注册" class="submit">
				</form>
			</div>
		</header>
		<!--头部 end-->
		<!--文章详情-->
		<div class="articledetail">
			<h4 style="text-align: center;margin:20px 0"><?php echo $row['title'];?></h4>
			<div>
				<?php echo $row['content'];?>

			</div>
		</div>
		
		<div class="gotop">
			<img src="../public/img/gotop.png" alt="" width="50" height="50">
		</div>
	</div>
	
</body>
<script src="../public/js/jquery.min.js"></script>
<script src="../public/js/index.js"></script>
</html>