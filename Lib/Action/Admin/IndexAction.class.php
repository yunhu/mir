<?php
class IndexAction extends PreAction {
    public function index(){
        $_SESSION['admin']['rand']=rand(1000,9999);
        $this->assign('flag',$_SESSION['admin']['rand']);
        $this->display('login');
    }

    public function main(){
        if(isset($_POST['tag'])||$_POST['tag']==$_SESSION['admin']['rand']){
        if(empty($_POST['name'])||empty($_POST['pwd'])){
            header("location:/admin/index");
        }else{
            if($_POST['name']=='admintiger'&&$_POST['pwd']=='tiger'){
                $_SESSION['admin']['login']=true;
                $this->show();
            }else{
                header("location:/admin/index");
            } 
        }
        }else{
            header("location:/admin/index");
        }
    }
    public function show(){
        if($_SESSION['admin']['login']==true){

            $this->assign('data',M('Article')->where(array('status'=>1))->select());
            $this->display('index');
        }else{
        
            header("location:/admin/index");
        }
    }
    
    public function update_article(){
        if(intval($_POST['pid'])>0){
            $where['pid']=array('in',$_POST['pid']);
            $data=M('Article')->where($where)->save(array('status'=>$_POST['status']));
            if($data)echo 1;else echo 0;
        }
    }
    public function logout(){
        unset($_SESSION['admin']);
        header("location:/admin/index");
    }

    public function putarticle(){
        $this->display('pubarticle');
    }
   
}
