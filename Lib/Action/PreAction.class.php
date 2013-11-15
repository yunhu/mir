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
    }
}
