<?php
class DescAction extends PreAction {
    public function index(){
        if(!$_SESSION['user']['login'])
        $this->redirect('user/index');
        $this->display('index',$data);
    }
    /**
     *
     *会员说明
     */
    public function memdesc(){
        if(!$_SESSION['user']['login'])
        $this->redirect('user/index');
        $data=array();
        $this->display('memdesc',$data);
    }

     /**
     *
     *积分说明
     */
    public function golddesc(){
        if(!$_SESSION['user']['login'])
        $this->redirect('user/index');
        $data=array();
        $this->display('score',$data);
    }
}
