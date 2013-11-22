<?php
 class ShowAction extends PreAction{
 	public function preview(){
 		if(isset($_GET['id'])&&$_GET['id']>0){
 			$data=M('product')->where(array('pid'=>$_GET['id']))->select();
 			if($data){
 			$this->assign('data',$data[0]);
 			$this->display('');
 				}else{
 				$this->redirect('/index/index');
 			}
 			
 		}else{
 			$this->redirect('/index/index');
 		}
 		
 	}
 }