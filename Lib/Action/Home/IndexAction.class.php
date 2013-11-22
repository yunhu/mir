<?php
class IndexAction extends PreAction {
    public function index(){
    	$data=M('Product')->where(array('status'=>0))->select();
    	$this->assign('data',$data);
        $this->display('index');
    }

   
}
