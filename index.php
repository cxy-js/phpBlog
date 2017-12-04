
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name=”description” content="cxy的php博客"> 
	<meta name=”keyword” content="PHP,PHP博客,mysql"> 
	<title>Cxy的php博客</title>
	<link rel="stylesheet" href="public/css/index.css">
</head>
<body>
	<div class="main">
		<!--头部-->
		<header class="head">
			<div class="brand"><a href="index.php"><img src="public/img/blog.png" height="50" width="160" alt=""></a></div>
			<form action="admin/select/selectarticle.php" method="GET" class="searchform">
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
					echo "<a href='admin.php' id='admin'>";
					echo "后台管理";
					echo "</a>";

				}elseif($_SESSION['isadmin']=='0'){
					//会员
					echo "<a href='admin/user/user.php' id='member'>";
					echo "个人中心";
					echo "</a>";
				}

				?>
				
				<a href="home/logout.php" id="geout"><?php
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
				<form action="home/login.php" method="post">
					<input type="text" class="search-input" name="uname" required placeholder="username">
					<input type="password" class="search-input" name="password" required  placeholder="password">
					<input type="submit" value="登陆" class="submit">
				</form>
			</div>
			<!--注册弹框-->
			<div class="register">
				<h4>用户注册</h4>
				<form action="home/register.php" method="post">
					<input type="text" class="search-input" name="uname" required placeholder="username">
					<input type="password" class="search-input" name="password" required  placeholder="password">
					<input type="hidden" value="0" name="isadmin">
					<input type="submit" value="注册" class="submit">
				</form>
			</div>
		</header>
		<!--头部 end-->
		<!--文章内容-->
		<div class="main-content">
		</div>

		<!--蒙板-->
		<div class="body-mark" style="position:absolute;top:0;left:0;width:1200px;height:100%;margin:0 auto;background:url(public/img/login-bg.jpg) no-repeat;background-size: 100% 100%;display:none;z-index:99;"></div>
	</div>
	<div class="gotop">
		<img src="public/img/gotop.png" alt="" width="50" height="50">

	</div>
</body>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/index.js"></script>
<script>
	var str="";
	$.ajax({
		type:"post",
		url:"admin/check.php",
		success:function(res){
			//转为文章数组
			var r= JSON.parse(res)
			$.each(r,function(index,value){
				
				str+="<div class='content'>"+
				"<h4 class='content-title'>"+value.title+"</h4>"+
				"<div class='content-info'>"+
				"<div id='content'>"+value.content+"</div>"+
				
				"</div>"+
				"<p class='check-content-info'>"+
				"<a href=home/articledetails.php?id="+value.id+
				" style='color:red'>"+
				"查看详情</a>"+
				"</p>"+
				"<div class='content-tag'>"+
				"<li>发布人: <span id='autho'>"+value.autho+"</span></li>"+
				"<li>发布时间:<span id='addtime'>"+value.addtime+"</span></li>"+
				"</div>"+
				"<div style='clear:both'></div>"+
				"</div>"
			})
			$(".main-content").html(str)
		}
	})
</script>
</html>