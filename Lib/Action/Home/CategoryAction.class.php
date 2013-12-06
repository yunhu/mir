<?php

class CategoryAction extends PreAction {
    /**
     *处理分类URL跳转
     *param 
     *return 
     */
    public function index(){
        if(isset($_GET['id'])){
            switch(intval($_GET['id'])){
                case 6:$this->redirect('/article/index/id/6');break;
                case 7:$this->redirect('/article/index/id/7');break;
                case 8:$this->redirect('/index/index');break;
                case 9:$this->redirect('/category/find');break;
                case 10:$this->redirect('/material/map');break;
                case 11:$this->redirect('/material/equipment');break;
                case 12:$this->redirect('/material/weapon');break;
                case 13:$this->redirect('/material/monster');break;
                case 14:$this->redirect('/tool/client');break;
                case 15:$this->redirect('/tool/login');break;
                case 16:$this->redirect('/tool/server');break;
                case 17:$this->redirect('/tool/plug');break;
                case 18:$this->redirect('/tool/course');break;
                case 19:$this->redirect('/article/index/id/19');break;
                default:$this->redirect('/index/index');break;
            }
        }else{
            $this->redirect('/index/index');
        }
    }
    
    /**
     *
     *我要找服
     */
    public function find(){
        $this->display('find');
    }
    /**
     *
     *去发布自己喜欢的服
     */
    public function tofind(){
        $this->display('tofind');
    }
}
