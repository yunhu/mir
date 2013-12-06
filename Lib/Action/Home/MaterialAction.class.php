<?php

class MaterialAction extends PreAction {
    /**
     *展示
     *param 
     *return 
     */
    public function index(){
        $this->share(13);
    }
    
    /**
     *传奇地图 
     *
     */
    public function map(){
        $this->share(10);
    }
     /**
     *传奇装备 
     *
     */
    public function equipment(){
    
        $this->share(11);
    }
    /**
     *传奇武器 
     *
     */
    public function weapon(){

        $this->share(12);
    }
   /**
     *传奇怪物 
     *
     */
    public function monster(){
        $this->share(13);
    
    }
    /**
     *共用函数
     *
     */
    public function share($pid){
        $data=M('Material')->where(array('type'=>$pid))->select();
        $this->display('index',$data);
    }
}
