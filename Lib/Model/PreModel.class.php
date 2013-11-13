<?php
class PreModel extends Model {
    public function __construct(){
        parent::__construct();   
    } 

    /**
     *插入表
     *para str
     *para array
     */
    public function insert($table,$arr){
        return M("$table")->add($arr);
    }

    /**
     *根据条件搜索
     *
     */
    public function select($table,$arr){
         return M("$table")->where($arr)->select(); 
    }

    /**
     *根据条件更新操作
     */
    public function update ($table,$con,$arr){
          return M("$table")->where($con)->save($arr); 
    }
}
