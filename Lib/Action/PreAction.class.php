<?php
class PreAction extends Action {
    public function __construct(){
       parent::__construct();   
       $this->assign('nav',$this->fetch_category());
       $this->assign('list',$this->header());
    }
	public function header(){
		return M('Product')->where(array('recommand'=>1,status=>0))->limit(10)->select();
	}

    /**
     *
     *分类获取
     */
    public function fetch_category(){
        switch(substr(get_class($this),0,-6)){
        case 'Index':$id=1;break;
        case 'Material':$id=2;break;
        case 'Tool':$id=3;break;
        case 'Article':$id=4;break;
        default :$id=1;break;
        }
        return M('Category')->where(array('pid'=>$id))->select();
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
