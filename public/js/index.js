//登陆弹框
var flag=true
$("#i-login").click(function(e){
	//取消冒泡
	e.stopPropagation()
	name(".login",flag)
});
//注册弹框
var flag=true
$("#i-register").click(function(e){
	//取消冒泡
	e.stopPropagation()
	name(".register",flag)
	
});
document.addEventListener("click",function(){
	flag=true;
	$(".login").animate({
		top:"-480px",
		left:"450px"
	},100);
	$(".register").animate({
		top:"-480px",
		left:"450px"
	},100);
	$(".body-mark").css({display:"none"});
})
//取消冒泡
$(".login,.register").click(function(e){
	e.stopPropagation()
})
//名
function name(name,flag){
	$(name).animate({
		top:"100px",
		left:"450px"
	},500)
	if(flag){
		$(".body-mark").css({display:"block"});
		flag=false
	}else{
		$(name).animate({
			top:"-480px",
			left:"450px"
		},100)
		flag=true
	}
}

	//返回顶部
	$(".gotop").click(function(){
		//返回顶部时间0.5秒
		$("body,html").animate({scrollTop:0},500)
	});
	//判断滚动条的scrollTop大于一屏的高度(可增大或减小)后，来显示返回顶固按钮
	$(window).scroll(function(){
		if ($(window).scrollTop()>$(window).height()-200) {
			$(".gotop").fadeIn(500); 
		}else{
			$(".gotop").fadeOut(500);
		}

	})	