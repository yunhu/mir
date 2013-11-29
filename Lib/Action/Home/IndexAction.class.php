<?php
class IndexAction extends PreAction {
    public function index(){
    	$data=M('Product')->where(array('status'=>0))->order('server_time')->select();
        if(!NTIME){
            $data=$this->deal_time($data);
        }
    	$this->assign('data',$data);
        $this->display('index');
    }

    //假时间处理数据
    public function deal_time($data){
        $num=count($data);
        $sec=date("i",time());
        //获得当前，年月日 时
        $str=date("Y-m-d H",time());
        $str.=':00:00';
        $time=strtotime($str);
        if($sec>30){
            $time=$time+3600;
        }else{
            $time=$time+1800;
        }
        for($i=0;$i<$num;$i++){
            $data[$i]['server_time']=$time;
        }
        return $data;
    }
   
}
