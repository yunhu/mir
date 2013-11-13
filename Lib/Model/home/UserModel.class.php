<?php
class UserModel extends PreModel {
    

    /**
    *根据条件检测用户信息是否存在
    *
    */
    public function check_name($array){
       $model=M("User");   
       return   $model->where($array)->select();
    }
 
    
   /**
    *获取用户相关信息
    */
    public function fetch_userinfo($uid){
        return M()->table('mir_user_score s')->join('mir_user_allow a on s.uid=a.uid')->where(array('s.uid'=>$uid))->find();
    }
    /**
    *注册用户
    *
    */
    public function register($array){
        $model=M('user');
        return $model->add($array);
    }

    /**
     *把用户登陆时间和IP写入用户表
     *
     */
    public function record($name,$arr){
        $model=M('user');
        return $model->where(array('name'=>$name))->save($arr);
    } 
}


