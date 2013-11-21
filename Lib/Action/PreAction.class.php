<?php
class PreAction extends Action {
    public function __construct(){
        parent::__construct();   
        
        
    }

    /**
     *
     *检测是否登陆 
     */
    
    /**
     * 
     * 图片上传 
     */
    public function upload (){
    	 import('@.ORG.UploadFile');
    	 $upload = new UploadFile();
    	 $upload->maxSize  = 200000 ;// 设置附件上传大小200k
		 $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		 $upload->savePath =  './Public/upload/';// 设置附件上传目录
    if(!$upload->upload()) {// 上传错误提示错误信息
		return	$this->error($upload->getErrorMsg());
 	}else{// 上传成功 获取上传文件信息
		return  $upload->getUploadFileInfo();
		
 	}
 
    }
  /**
     * 刪除多餘圖片
     */
    public function del_img($img){
    	
    	if(!empty($_SESSION['user']['upimg'])){
    		unlink('./Public/upload/'.$_SESSION['user']['upimg']);
    		$_SESSION['user']['upimg']=$img;
    	}else{
    		$_SESSION['user']['upimg']=$img;
    	}
    }
}
