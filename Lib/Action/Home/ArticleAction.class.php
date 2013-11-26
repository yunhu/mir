<?php

class ArticleAction extends PreAction {
    /**
     *展示
     *param 
     *return 
     */
    public function index(){
        $count=M('Article')->where(array('status'=>0))->count();
   		import('ORG.Util.Page');
     	$Page = new Page($count,10);
     	$show  = $Page->show();
     	$list = M('Article')->where(array('status'=>0))->limit($Page->firstRow.','.$Page->listRows)->select();
     	$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);

        $this->display('article');
    }
    
    /**
     *
     *文章展示
     */
    public function preview(){
        if(intval($_GET['id'])>0){
            $data=M("Article")->where(array('pid'=>$_GET['id']))->select();
            $this->assign('data',$data[0]);
            M('Article')->where(array('pid'=>$_GET['id']))->setInc('click',1);
            $this->display('article_detail');
        }else{
            $this->redirect('/index/index');
        }
    }
}
