<?php
class PriAction extends PreAction {
   
    public function check(){
        if(intval($_POST['pid'])>0){
            $where['pid']=array('in',$_POST['pid']);
            $data=M('Product')->where($where)->save(array('status'=>$_POST['status']));
            if($data)echo 1;else echo 0;
        }
    }

    public function recompri(){
    
         $this->assign('data',M('Product')->select());
        $this->display('recom');
    }
    public function recom(){
        if(intval($_POST['pid'])>0){
            if(M('Product')->where(array('pid'=>$_POST['pid']))->save(array('recommand'=>$_POST['status']))) echo 1;else echo 0;
        }else{
            echo 3;
        }
    }
    public function show(){
        $this->assign('data',M('Product')->where(array('status'=>1))->select());
        $this->display('pri');
    }
   
}
