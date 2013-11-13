<?php


/*
 *加载文件
 */
require_once './Denglu.php';


/*
 *初始化接口类Denglu
 */
$api = new Denglu('74187denF7qF4kG1QN1fDMJsHZjEiA','37928741aGPeJ0of5MN5kfESBXbVT5','utf-8');

/*
 *调用接品类相关方法获取媒体用户信息示例
 */
if(!empty($_GET['token'])){
     
	try{
		$userInfo = $api->getUserInfoByToken($_GET['token']);
       
	}catch(DengluException $e){//获取异常后的处理办法(请自定义)
		//return false;		
		//echo $e->geterrorCode();  //返回错误编号
		//echo $e->geterrorDescription();  //返回错误信息
	}
}
/*
 *发送绑定请求
 */
try{
	$result = $api->bind( $mediaUID, $uid, $uname, $uemail);
}catch(DengluException $e){
	//处理办法同上
}

/*
 *发送解除绑定请求
 */
try{
	$result = $api->unbind( $mediaUID);
}catch(DengluException $e){
	//处理办法同上
}

/*
 *获取网站可用的媒体信息
 */
try{
	$result = $api->getMedia();
}catch(DengluException $e){
	//处理办法同上
}

/*
 *推送媒体用户登录新鲜事
 */
try{
	$result = $api->sendLoginFeed($mediaUserID);
}catch(DengluException $e){
	//处理办法同上
}

/*
 *分享内容
 */
try{
	$result = $api->share( $mediaUserID, $content, $url, $uid);
}catch(DengluException $e){
	//处理办法同上
}

/*
 *发送解除用户所有已绑定媒体用户的新求
 */
try{
	$result = $api->unbindAll($uid);
}catch(DengluException $e){
	//处理办法同上
}


?>
