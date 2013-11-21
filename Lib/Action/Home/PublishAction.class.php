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
	 * 我的私服
	 * Enter description here ...
	 */
     public function mymir(){
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
     * 检查用户是否被封
     */
    public function check_user(){
    
    }
    
  	/**
     * 
     * 检查IP是否被封
     */
    public function check_ip(){
    
    }
    
	/**
     * 
     * 检查发布权限 时间是否过期
     */
    public function check_ip(){
    
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
        $this->display('info');
    }
     /**
	 * 
	 * 
	 * my article
	 * Enter description here ...
	 */
     public function myarticle(){
        $this->display('',$data);
    }
    
 	/**
	 * 
	 * 
	 * publish article
	 * Enter description here ...
	 */
     public function pubarticle(){
        $this->display('');
    }
   
}
