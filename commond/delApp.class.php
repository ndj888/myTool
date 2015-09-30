<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 14:14
 */
class delAppCom extends Commond
{
    public function run(){
        $name = $this->param[0];
        if ( $id = $this->getId($name )){
            $this->delApp($id);
        }else{
            echo $this->named.'该APP不存在！';
        }
    }

    private function getId($name){
        $this->db->where('name' , $name , '=');
        $id = $this->db->get('myapp' , [0 , 1] , 'id')[0]['id'];
        return $id ? $id : false;
    }

    private function delApp($id){
        $this->db->where('id' , $id , '=');
        if ( $this->db->delete('myapp') ){
            echo $this->named.'删除'.$this->param[0].'成功';
        }
    }
}