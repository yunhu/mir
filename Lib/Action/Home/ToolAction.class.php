<?php

class ToolAction extends PreAction {
    /**
     *展示
     *param 
     *return 
     */
    public function index(){
        $this->share(16);
    }
    
    /**
     *
     *客户端
     */
    public function client(){
        $this->share(14);
    }
    /**
     *登陆器
     */
    public function login(){
        $this->share(15);
    }

    /**
     *服务端
     */
    public function server(){
        $this->share(16);
    }
    /**
     *外挂
     *
     */
    public function plug(){
        $this->share(17);
    }
    /**
     *教程
     */
    public function course(){
        $this->share(18);
    }
    
    /**
     *共享
     */
    public function share($pid){
   		 import('ORG.Util.Page');
        $count=M('Material')->where(array('type'=>$pid))->count();
     	$Page = new Page($count,10);
     	$show  = $Page->show();
     	$list = M('Material')->where(array('type'=>$pid))->limit($Page->firstRow.','.$Page->listRows)->select();
     	$this->assign('toolist',$list);// 赋值数据集
        $this->assign('page',$show);
        $this->display('index');
    }
    /**
     *详情
     */
    public function detail(){
        if(intval($_GET['id'])>0){
            $data=M('Material')->where(array('pid'=>$_GET['id']))->select();
            $this->assign('detaildata',$data[0]);
            $this->display('detail');
        }
    }
}
