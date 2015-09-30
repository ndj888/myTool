<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 13:41
 */
class updAppCom extends Commond
{
    public function run(){
        $param = $this->param;
        $name = isset($param[0]) ? $param[0] : '';
        $title = isset($param[1]) ? $param[1] : '';
        $type = isset($param[2]) ? $param[2] : '';
        $dir = isset($param[3]) ? $param[3] : '';

        if ( $this->appIsExist($name)){
            $this->db->where('name' , $name , '=');
            $res = $this->db->update('myapp' , ['name' => $name , 'title' => $title , 'type' => $type , 'path' => $dir]);
            if ( $res ){
                echo $this->named.'更新已经完成';
            }else{
                echo $this->db->getLastError();
            }
        }else{
            echo $this->named.'应用不存在，请先创建吧！';
        }
    }
}