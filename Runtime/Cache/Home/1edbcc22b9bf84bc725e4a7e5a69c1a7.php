<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>index</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="imagetoolbar" content="no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<link href="__PUBLIC__/css/css.css" rel="stylesheet" media="screen" type="text/css" />
<script language="javascript" type="text/javascript" src="__PUBLIC__/js/jqmin.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/js/layer/layer.min.js"></script>
</head>
<body class="index">
<!-- header -->
	<div class="head">
		<div id="navMenu">
		<ul>
			<li style="margin-left:0px;"><a href='/index/index'><span>首页</span></a></li>
			<li><a href=''><span>传奇素材</span></a></li>
			<li><a href=''><span>资料下载</span></a></li>
			<li><a href=''><span>相关文章</span></a></li>
			<li><a href=''><span>文坛</span></a></li>
		</ul>
		</div>
		<div class="headbody">
			<div class="lhead">
				<div class="divcss" style="height:29px;">
				<div class="left"><span>站长推荐：</span></div>
				<div class="right"><span>今天是2013年10月1号</span></div>
				</div>
				<div  class="divcss">
				<div class="center former">
					<ul>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					<li><span>无忧传奇</span></li>
					</ul>
				</div>
				</div>
			</div>
			<div class="chead">
				<div class="divcss" style="height:120px;">
					<img src="__PUBLIC__/images/logo.gif" width="500px" height="120px" />
				</div>
				<div  class="divcss" style="height:29px;">
					<form action=""  enctype="multipart/form-data" method="post">
						<input type='text' value='传奇私服名/版本/线路' style="font-size:13px;width:357px;height:29px;float:left;"/>
						<input type="submit" value="本站搜索" style="font-size:13px;width:68px;height:28px;float:left;">
						<input type="submit" value="百度搜索" style="font-size:13px;width:68px;height:28px;float:right;_margin-left:-8px;">
					</form>
				</div>
			</div>
			<div class="rhead">
				<ul>
					<li><a href=""><span>关于我们</span></a> | <a href=""><span>加入收藏</span></a> |<a href=""><span>设为首页</span></a> </li>
                    <?php if(isset($_SESSION['user']['login'])&&$_SESSION['user']['login']==true){;?>
                    <li><a href="javascript:;"><span>欢迎:<a href="/user/member"><?php echo $_SESSION['user']['name'];?></a></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/logout"><span>退出</span></a>&nbsp;&nbsp;</li>
                    <?php }else{ ?>
                    <li><a href="/user/login"><span>登陆</span></a>&nbsp;&nbsp;<a href="/user/reg"><span>注册</span></a>&nbsp;&nbsp;<a href="/user/forget"><span>忘记密码</span></a>&nbsp;&nbsp;</li>
                    <?php }?>

					<li><p><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=850952907&site=qq&menu=yes"> 
<img border="0" src="__PUBLIC__/images/qq.gif" alt="联系我们" title="联系我们"> 
</a></p></li>
				</ul>
			</div>
		</div>
		<div class="bhead">
			<ul>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>家族私服</span></a></li>
				<li><a href=""><span>我要找服</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li><a href=""><span>私服首页</span></a></li>
				<li style="*width:95.9px;"><a href=""><span>私服首页</span></a></li>
			</ul>
		</div>
	</div> 
   

<!-- body -->
	<div class="body">
		<div class="content">
			<div class="member">
					<h2 style="margin:20px;">会员中心</h2>

<div class="memberhead">
  <div><a href="/user/member">会员首页</a></div>
  <div><a href="/publish/">发布私服</a></div>
  <div><a href="/publish/mymir">我的私服</a></div>
  <div><a href="/publish/info">我的信息</a></div>
  <div><a href="/publish/myarticle">我的文章</a></div>
  <div><a href="/publish/pubarticle">发布文章</a></div>
</div> 
<div class="memberbody">
	<ul>
        <li>欢迎,<?php echo ($user["name"]); ?>来到私服010;您上次退出时间为:<?php echo ($user["lastlogintime"]); ?> 上次登陆IP为:<?php echo ($user["lastloginip"]); ?></li>
        <li><div class="w">会员等级:<?php echo ($user["level"]); ?></div><div class="w"></div><div class="w"><a href="/desc/memdesc">会员等级说明</a></div></li>
        <li><div class="w">我的金币:<?php echo ($user["gold"]); ?></div><div class="w"><img src="__PUBLIC__/images/money.jpg" width="20" height="22" /></div><div class="w">充值</div></li>
        <li><div class="w">我的积分:</div><div class="w"></div><div class="w">总积分:<?php echo ($user["info"]["score"]); ?></div><div class="w">已用积分:<?php echo ($user["info"]["used_score"]); ?></div><div class="w">未用积分:<?php echo ($user["info"]["unused_score"]); ?></div><div class="w"><a href="/desc/memdesc">积分使用说明</a></div></li>
        <?php if($user['info']['type'] == 1): ?><li><div class="w">许可证:包月</div><div class="w"></div><div style="width:250px;" class="w">有效时间:<?php echo (date("Y/m/d",$user["info"]["start_time"])); ?>-<?php echo (date("Y/m/d",$user["info"]["end_time"])); ?></div></li><?php endif; ?>
	</ul>
</div>
			</div>
		</div>
	</div>
<!-- /body -->
<!-- footer -->

	<div class="flink">
			<div class="ftitle">友情链接：</div>
			<div class="fbody">
				<ul>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
					<li><a href=""><span>传奇发布网</span></a></li>
				</ul>
			</div>
	</div>
	<div class="footer">
		<div class="foot">
			<div class="fbody">
				<div class="fnav">
					<ul>
						<li><a href=""><span>设为首页</span></a></li>
						<li style="float:left;color:#000;text-align:center;font-size:14px;width:4px!important;width:4px;">|</li>
						<li><a href=""><span>联系我们</span></a></li>
						<li style="float:left;color:#000;text-align:center;font-size:14px;width:4px!important;width:4px;">|</li>
						<li><a href=""><span>关于我们</span></a></li>
						<li style="float:left;color:#000;text-align:center;font-size:14px;width:4px!important;width:4px;">|</li>
						<li><a href=""><span>收藏本站</span></a></li>
						<li style="float:left;color:#000;text-align:center;font-size:14px;width:4px!important;width:4px;">|</li>
						<li><a href=""><span>友情链接</span></a></li>
					</ul>
				</div>
				<div class="fp">
					<p>Copyright 2012 www.sifu010.com All Rights Reserved</p>
					<p>请合理发布游戏！</p>
				</div>
			</div>
		</div>
	</div>
<!-- /footer -->
</body>
</html>