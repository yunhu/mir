<?php
class PublishAction extends PreAction {
	/**
	 * 
	 * 
	 * 私服发布
	 * Enter description here ...
	 */
    public function index(){
    	 import('@.ORG.UploadFile');
    	 $upload = new UploadFile();
    	 $_SESSION['user']['upimg']='';
         $this->display('publish');
    }
    
    
    /**
     * 
     * 
     * 
     * 接收发布信息
     */
    public function receive_publish(){
    	//组合数据
    	$data=$_POST;
    	$time=strtotime($_POST['server_time'].' '.$_POST['Menu1'].':'.$_POST['Menu2'].':0');
    	unset($data['Menu1']);
    	unset($data['Menu2']);
    	$data['server_time']=$time?$time:time();
    	$data['uid']=$_SESSION['user']['uid'];
    	$data['add_time']=time();
    	//组合数据，是否不用审核
    	$data=$this->deal_data($data);
    	//是否包月
    	if($this->check_month()){
    		$data['status']=0;
    		D('Pre')->insert('product',$data);
    	}else{
    		$score=D('Pre')->select('user_score',array('uid'=>$_SESSION['user']['uid']));

    		if($score[0]['unused_score']>=SCORE){
    			$score[0]['unused_score']-=SCORE;
    			$score[0]['used_score']+=SCORE;
    			M('UserScore')->save($score[0]);
    			D('Pre')->insert('product',$data);
    		}else{
    			echo 2;
    		}
    		//检查积分是否够发布使用，并扣除积分
    	}
    	
    }
   
    	
    
    
    
    /**
     * 
     * 
     * 根据用户级别处理发布数据,3级别以上不能审核
     */
    public function deal_data($data){
    	
    	$user=D('Pre')->select('user',array('uid'=>$data['uid']));
    	if($user[0]['level']>=3){
    		$data['status']=0;
    		
    	}
    	return $data;
    }
    
	/**
	 * 
	 * 
	 * 我的私服
	 * Enter description here ...
	 */
     public function mymir(){
     	$count=M('Product')->where(array('uid'=>$_SESSION['user']['uid']))->count();
   		import('ORG.Util.Page');
     	$Page = new Page($count,2);
     	$show  = $Page->show();
     	$list = M('Product')->where(array('uid'=>$_SESSION['user']['uid']))->order('add_time')->limit($Page->firstRow.','.$Page->listRows)->select();
     	$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);
        $this->display('mypublish');
    }
    public function upload(){
    	$info=parent::upload();
    	
    	if(is_array($info)){
    		$this->del_img($info[0]['savename']);
    		echo " <script> window.parent.document.getElementById('img').src='../Public/upload/{$info[0]['savename']}';window.parent.document.getElementById('pic').value='{$info[0]['savename']}';</script>";
    	    	
    	}
    }
    
    /**
     * 
     * 
     * 检查是否包月
     */
  
    public function check_month(){
    	    	
    	    	$userallow=M('UserAllow');
    
    	    	$time=time();
    	    	$month=$userallow->where("uid={$_SESSION['user']['uid']} and end_time >=$time")->limit(1)->select();
    	    	
    	    	if($time<=$month[0]['end_time']&&$time>=$month[0]['start_time']){
    	    		return true;
    	    	}else{
    	    		return false;
    	    	}
    }
  
    
    /**
     * 
     * 
     * 查看相应积分
     */
    
    
    
    /**
	 * 
	 * 
	 * 我的info
	 * Enter description here ...
	 */
     public function info(){
     	$user=D('Pre')->select('user',array('uid'=>$_SESSION['user']['uid']));
     	$this->assign('user',$user[0]);
        $this->display('info',$user);
    }
     /**
	 * 
	 * 
	 * my article
	 * Enter description here ...
	 */
     public function myarticle(){


        $count=M('Article')->where(array('uid'=>$_SESSION['user']['uid']))->count();
   		import('ORG.Util.Page');
     	$Page = new Page($count,2);
     	$show  = $Page->show();
     	$list = M('Article')->where(array('uid'=>$_SESSION['user']['uid']))->limit($Page->firstRow.','.$Page->listRows)->select();
     	$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);

        $this->display('',$data);
    }
  
 	/**
	 * 
	 * 
	 * publish article
	 * Enter description here ...
	 */
     public function pubarticle(){
      $this->assign('category',M('Category')->where(array('pid'=>4))->select());
        $this->display('');
    }
    /**
     *
     *接收文章
     */
    public function receive (){
        if($_POST['title']||$_POST['content']){
             $data=$_POST;
             $data['content']=$data['editorValue'];
             unset($data['editorValue']);
             $data['uid']=$_SESSION['user']['uid'];
             $data['apply_time']=time();
             $str="<br /><a href='http://www.sifu010.com'>来自私服010</a>";
             $data['content'].=$str;
             if(CHECK_ARTICLE==1){
                $data['status']=0;
             }
             if(D('Pre')->insert('article',$data)){
                header("location:/publish/pubarticle");
             }
        }else{
            echo "<script>history.go(-1)</script>";
        }
    }
    /**
     *
     *临时抓取文章
     */
    public function temp_aiticle(){
            $str=file_get_contents('http://www.5uwl.net/Article/ShowClass.asp?ClassID=1&page=1');
$url="http://www.5uwl.net";

preg_match('/\<table(.*?)\<\/table\>/',$str,$new);
preg_match_all('/href=\"(.*?)\"/',$new[0],$od);
preg_match_all('/title=\"(.*?)\"/',$new[0],$oda);

$num=count($od[1]);
for($i=0;$i<$num;$i++){
    $this->fetch_content($oda[1][$i],$url.$od[1][$i]);
}
    }


public function fetch_content($con,$url){
    $cona=file_get_contents($url);
   $res= preg_match_all('/\<td class=art03 vAlign=top align=left\>(.*)\<div id=\"bdshare\"/is',$cona,$resa);
    $last=preg_replace('/href=\"(.*?)\"/',"href='http://www.sifu010.com'",$resa[1][0]);
    file_put_contents($con.'.txt',$this->GetGB2312String(trim($last)));
}
   public function GetGB2312String($name)
{
$tostr = "";
for($i=0;$i<strlen($name);$i++)
{
   $curbin = ord(substr($name,$i,1));
   if($curbin < 0x80)
   {
    $tostr .= substr($name,$i,1);
   }elseif($curbin < bindec("11000000")){
    $str = substr($name,$i,1);
    $tostr .= "&#".ord($str).";";
   }elseif($curbin < bindec("11100000")){
    $str = substr($name,$i,2);
    $tostr .= "&#".$this->GetUnicodeChar($str).";";
    $i += 1;
   }elseif($curbin < bindec("11110000")){
    $str = substr($name,$i,3);
    $gstr= iconv("UTF-8","GB2312",$str);
    if(!$gstr)
    {
    $tostr .= "&#".$this->GetUnicodeChar($str).";";
    }else{
    $tostr .= $gstr;
    }
    $i += 2;
   }elseif($curbin < bindec("11111000")){
    $str = substr($name,$i,4);
    $tostr .= "&#".$this->GetUnicodeChar($str).";";
   
    $i += 3;
   }elseif($curbin < bindec("11111100")){
    $str = substr($name,$i,5);
    $tostr .= "&#".$this->GetUnicodeChar($str).";";
   
    $i += 4;
   }else{
    $str = substr($name,$i,6);
    $tostr .= "&#".$this->GetUnicodeChar($str).";";
   
    $i += 5;
   }
}

return $tostr;
}//end function
public function GetUnicodeChar($str)
{
$temp = "";
for($i=0;$i<strlen($str);$i++)
{
   $x = decbin(ord(substr($str,$i,1)));
   if($i == 0)
   {
    $s = strlen($str)+1;
    $temp .= substr($x,$s,8-$s);
   }else{
    $temp .= substr($x,2,6);
   }
}
} 
}
