<?php
class UserAction extends PreAction {

  
    /**
     *注册显示页面
     *
     */
    public function reg(){
            $_SESSION['user']['reg']=rand(1000,9999);
            $data['reg']=$_SESSION['user']['reg'];
            $this->assign($data);
            $this->display('register',$data);
    }

    /**
     *
     *
     */ 
    public function index(){
        $this->login();
    }
    /**
     *登陆展示页面
     *
     */
    public function login(){
        if($_SESSION['user']['login']){$this->redirect('/user/member');
        
        }else{
            $data=array();
            $this->display('login',$data);
        }
    }
    /**
     *用户登陆记录session
     */
    public function login_check(){ 
        $data=$_POST;
        $data['pwd']=md5($data['pwd']);
        if(D('User')->check_name($data)) {
            $_SESSION['user']['login']=true;
            $_SESSION['user']['name']=$data['name'];
            echo 1;
        }else{
            echo 0;
        }
    }

    /**
     *获得请求来源IP和时间记录登陆
     *
     */
    public function user_record($name){
        $data['lastloginip']=ip2long($_SERVER['REMOTE_ADDR']);
        $data['lastlogintime']=time();
        if(D('User')->record($name,$data)) return 1;
        else 
                                     return 0;
    }
    
    /**
     *qq回调
     *
     */
    public function callback(){
       //检测是否存在
        if($_GET['token']){
            if(D('Pre')->select('user',array('openid'=>$_GET['mediaUserID']))){
                $_SESSION['user']['login']=true;
                $_SESSION['user']['name']=$_GET['mediaUserID'];
                $this->redirect('/user/member');
                 
            }else{
                if(D('Pre')->insert('user',array('name'=>$_GET['mediaUserID'],'openid'=>$_GET['mediaUserID'],'pwd'=>md5('123456'),'token'=>$_GET['token']))){

                $_SESSION['user']['login']=true;
                $_SESSION['user']['name']=$_GET['mediaUserID'];
                $this->redirect('/user/member');
                }else{
                    echo "<script>alert('出现异常,请刷新重试')</script>";
                }
            }
        }
      

    }

    public function denglu(){
        require_once("./sdk/denglu/Denglu.php");
       /*
 *初始化接口类Denglu
 */
$api = new Denglu('74187denF7qF4kG1QN1fDMJsHZjEiA','37928741aGPeJ0of5MN5kfESBXbVT5','utf-8');
var_dump($api);
die;
/*
 *调用接品类相关方法获取媒体用户信息示例
 */
if(!empty($_GET['token'])){
     
	try{
		$userInfo = $api->getUserInfoByToken($_GET['token']);
       
        var_dump($userInfo);
	}catch(DengluException $e){//获取异常后的处理办法(请自定义)
		//return false;		
		//echo $e->geterrorCode();  //返回错误编号
		//echo $e->geterrorDescription();  //返回错误信息
	}
}
var_dump($_GET);
die;
/*
 *发送绑定请求
 */
try{
	$result = $api->bind( $mediaUID, $uid, $uname, $uemail);
    var_dump($result);
}catch(DengluException $e){
	//处理办法同上
   echo $e->geterrorDescription();  
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

    }

    public function receriver(){
    
    }

     public function bind(){
    
    }

    /**
     *用户首页
     *
     */
    public function member(){
        if(!$_SESSION['user']['login'])
            $this->redirect('user/index');
        if(isset($_SESSION['user']['login'])&&$_SESSION['user']['login']==true)
        {
            $user_data=D('Pre')->select('user',array('name'=>$_SESSION['user']['name']));
            $data['user']=$user_data[0];
            $data['user']['info']=$this->fetch_info_user($user_data[0]['uid']);
            $data['user']['lastlogintime']=date("Y-m-d H:i:s",$data['user']['lastlogintime']);
            $data['user']['lastloginip']=long2ip($data['user']['lastloginip']);
            $this->assign($data);
            $this->display('member',$data);
        }
        else
        {
            $this->redirect('index/index');
        }
        
    }

    /**
     *获取用户积分和用户认可类型
     *
     */
    public function fetch_info_user($uid){
        $data=D("User")->fetch_userinfo($uid);
        if($data) return $data;
        else     return false;
    }
    
     /**
     *用户注册功能 
     *
     */
    public function register(){
        if($_POST['reg']!=$_SESSION['user']['reg']){
            echo 'virtual';//虚拟提交
        }else{
            $data=$_POST;
            array_pop($data);
            $data['pwd']=md5($data['pwd']);
            $data['regtime']=time();
            $_SESSION['user']['login']=true;
            $_SESSION['user']['name']=$data['name'];
            echo D("User")->register($data);
        }
        
    }
    
     /**
      *用户退出 需要写入 上次登陆时间和IP
      *
      */
    public function logout(){
       if($this->user_record($_SESSION['user']['name'])){ 
            unset($_SESSION['user']);
            $this->redirect('/user/member');
       }
    }
     /**
     *AJAX检测用户名是否重复
     */
    public function check_name(){

        if(D('User')->check_name($_POST)) 
            echo 1;
        else 
            echo 0;
    }


    /**
     *邮箱找回密码
     */
    public function forget(){
        $this->display('getpass');
    }
    /**
     *检测邮箱和帐户是否正确
     */
    public function check_email(){
        if(D('User')->check_name($_POST)){ 
            if($this->send_email($_POST))
            echo 1;
            else 
            echo 2;
        }else{
            echo 0;
        }
    }


    /**
     *更新用户密码
     *
     */
    public function changepass (){
        if($_POST['pwd']&&isset($_SESSION['tag'])&&$_POST['code']){
            if($_SESSION['tag']==$_POST['tag']){
                $name=D('Pre')->select('email',array('code'=>$_POST['code']));
                //查看用户是否存在
                if($name){
                    if($name[0]['start_time']-time()>C('CHECK_TIME_EMAIL')){
                        echo 'timeout';
                    }else{
                         if(D('Pre')->update('user',array('name'=>$name[0]['name']),array('pwd'=>md5($_POST['pwd'])))) echo 1;
                         else 
                             echo 0;
                    }
                }else{
                    echo 'nouser';
                }
               
            }else{
                echo 'virtual';
            }
        }else{
            echo 'virtual';
        }
    }

    /**
     *检测邮件返回是否正确
     *
     */
    public function check_reback_email(){
        if(isset($_GET['code'])){
              
        $res=D('Pre')->select('email',array('code'=>$_GET['code']));
    
            if($res){
                if((time()-$res[0]['start_time'])>C('CHECK_TIME_EMAIL')){
                     $this->display('email_timeout');
                }else{
                     $data['tag']=rand(1000,9999);
                     $_SESSION['tag']=$data['tag'];
                     $this->assign($data);
                     $this->display('email_back',$data);
                }
               
            }else{
                $this->display('email_error');
            }
      
        }else{
            $this->display('error');
        }
        
    }
    /**
     *
     *发送邮件
     */
    public function send_email($arr){
        $arr['code']=md5(uniqid());
        $arr['start_time']=time();
        D('pre')->insert('email',$arr);
        $url='http://'.C('WEB_SITE').'/user/check_reback_email/code/'.$arr['code'];
            $str='<font color=black size=4>尊敬的'.$arr['name'].'&nbsp;您好!</font><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您正在申请的是私服010重置密码业务:<br/>请点击下面按钮来重置您的密码<a href='.$url.'>点击这里</a><br /> 来自:http://www.sifu010.com';
        $res=think_send_mail($arr['email'],$arr['name'],'私服010',$str);
        if($res)return true;
        else
            return false;
    }
}
