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
