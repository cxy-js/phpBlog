
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台</title>
	<link rel="stylesheet" href="public/css/admincss.css">
	
</head>
<body>
	<!--后台头部-->
	<header class="admin-head">
		<div class="brand">
			<a href="index.php">
				<img src="public/img/blog1.png" height="50" width="160" alt="">
			</a>
		</div>
		<div class="right">

			<a>欢迎&nbsp;&nbsp;&nbsp;<span  style="color:red"><?php session_start();echo $_SESSION['username']?></span></a>
			<a href="home/logout.php">退出</a>
			<a href="javascript:void(0);" style="color:#ccc;border-radius:4px;border:1px solid #fff;padding:2px 6px" id="updateuser">修改用户等级</a>
			<!--修改用户等级表单-->
			<form action="home/updateuser.php" method="get" class="updateuser" id="updateuserform">
				<span id="search-username">
					用户名: <input type="text"  class="search-input" name="uname" >
				</span>
				<input type="submit" value="Update" class="submit" id="search-update">
			</form>
			<!--修改用户等级的显示-->
			<script>
				var updateuser = document.getElementById("updateuser");
				var updateuserform = document.getElementById("updateuserform");
				var searchupdate = document.getElementById("search-update");
				var searchusername = document.getElementById("search-username");
				updateuser.onclick=function(e){
					e.stopPropagation();
					updateuserform.style.display="block";
				}
				document.addEventListener("click",function(){
					updateuserform.style.display="none";
				});
				searchupdate.addEventListener("click",stopPropagatio);
				function stopPropagatio(e){
					e.stopPropagation()
				}
				searchusername.addEventListener("click",stopPropagatio1);
				function stopPropagatio1(e){
					e.stopPropagation()
				}
			</script>
		</div>
	</header>
	<div class="main">
		<div class="left">
			<div class="user">
				<h4>后台管理</h4>
				<span>|-查看用户</span>
				<span>|-添加用户</span>
				<span>|-查看文章</span>
				<span>|-添加文章</span>
			</div>
			
		</div>
		<div class="right">
			<!--查看用户-->
			<div style="display:block" class="m">
				<?php
				session_start();
				if(!$_SESSION['username']){
					echo "<script>location='../index.php'</script>";
					exit();
				}
				//链接数据库配置项
				include 'public/dsn.config.php';
				//链接数据库
				$pdo = new PDO(DSN,ROOT,PASSWORD);
				$sql = "select id,username,password,isadmin from user order by id";
				$smt = $pdo->query($sql);
				//查询所有
				$rows =$smt->fetchAll(PDO::FETCH_ASSOC);
				//echo json_encode($row);//编码为json,是个字符串，前端需要JSON.parse(),

				?>
				<!--查看用户-->
				<table width=900  border=1 style="border-collapse:collapse" cellspacing="0" cellpadding="6px" class="table-select-uer">
					<tr>
						<th>id</th>
						<th>用户名</th>
						<th>密码</th>
						<th>是否管理员</th>
						<th>操作</th>
					</tr>
					<?php
					foreach($rows as $r){
						echo "<tr id='t{$r['id']}'>";
						echo "<td>{$r['id']}</td>";
						echo "<td>{$r['username']}</td>";
						echo "<td>{$r['password']}</td>";
						echo "<td>{$r['isadmin']}</td>";
						echo "<td>
						<a class='change' num='{$r['id']}' style='margin-right:5px'>修改密码</a>
						<a class='del' num='{$r['id']}'>删除</a></td>";
						echo "</tr>";
					}
					?>
					<!--修改用户的表单-->
					<div class="changeform" style="display:none">
						<h3 class="changeform-h3">修改用户密码</h3>

						<!-- <input type="text" id="changeuname" class="search-input m-input" name="uname" required placeholder="username"> -->

						<input type="password" id="changepassword" class="search-input m-input" name="password" required  placeholder="password">
						<div class="isadmin">
							<span style="color:#fff">是否为管理员</span>
							<input type="checkbox" value="1" name="isadmin" id="check" style="display:inline-block;width:15px;height:15px">
						</div>
						<input type="submit" value="修改" class="submit changebtn">
						<i class="x">×</i>
						<span class="changeinfo"></span>
					</div>
				</table>
			</div>
			<!--添加用户-->
			<div class="m">
				
				<form action="admin/user/add.php" method="post">
					<input type="text" class="search-input m-input" name="uname" required placeholder="username">
					<input type="password" class="search-input m-input" name="password" required  placeholder="password">
					<input type="submit" value="添加" class="submit m-input">
				</form>
			</div>
			<!--查看文章-->
			<div class="m">
				<?php
				include 'public/dsn.config.php';
				$pdo = new PDO(DSN,ROOT,PASSWORD);
				$sql = "select title,content from article";
				$smt=$pdo->query($sql);
				$rows=$smt->fetchAll(PDO::FETCH_ASSOC);
				if($rows){
					echo "<pre>";
					foreach ($rows as $r) {
						echo "<div>";
						echo "<div style='border:1px solid #ccc;margin:10px 0;width:100%;white-space: pre-wrap;'>";
						echo "<span style='display:block;margin:2px'>{$r['title']}</span>";
						echo "</br>";
						echo "<span>{$r['content']}</span>";
						echo "</div></div>";

					}
				}
				?>

			</div>
			<!--添加文章-->
			<div class="m">
				
				<form action="admin/article/article.php" method="post">
					<input type="text" class="search-input m-input" name="title" required placeholder="标题">
					<textarea rows="10" cols="80" name="content" placeholder="内容......"></textarea>
					<input type="submit" value="执行" class="submit m-input">
				</form>
			</div>
			
		</div>
		<div style="clear:both"></div>	
	</div>
	
</body>
<script src="public/js/jquery.min.js"></script>
<script>
	$("h4").click(function(){
		$('.user span').slideToggle()
	})

	$(".left span").click(function(){
		$(".right div.m").hide().eq($(this).index()-1).show();
	})
	//ajax删除用户
	$('.del').click(function(){
		var num = $(this).attr('num');
		$.get("admin/user/del.php?id="+num,function(res){
			if(res==="1"){
				$("#t"+num).remove()
			}
		})
	})
	
	//ajax修改用户
	$('.change').click(function(){
		$(".changeform").show();
		var num = $(this).attr('num');
		$(".changebtn").click(function(){
			var check = document.getElementById('check');
			var val;
			if(check.checked){
				val=check.getAttribute('value');
			}else{
				val='0'
			}
			if($("#changeuname").val()=="" || $("#changepassword").val()==""){
				return false
			}
			$.ajax({
				type:"post",
				url:"admin/user/change.php",
				data:{
					// uname:$("#changeuname").val(),
					uid:num,
					password:$("#changepassword").val(),
					isadmin:val
				},
				success:function(res){

					if(res==='success'){
						console.log(res)
						$(".changeform").hide();
						location.reload() 
					}
					if(res==='fail'){
						console.log(res)
						$(".changeinfo").html("密码重复");

					}
				}

			})
		})
	})
	$(".x").click(function(){
		$(".changeform").hide()
	})
</script>
</html>