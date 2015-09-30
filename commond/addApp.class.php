<?php
/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 13:09
 */

class addAppCom extends Commond{

    public function run(){
        $param = $this->param;
        $name = isset($param[0]) ? $param[0] : '';
        $title = isset($param[1]) ? $param[1] : '';
        $type = isset($param[2]) ? $param[2] : '';
        if ( !$name || !$title || !$type){
            echo $this->named.'请检查参数是否正确!';
            return;
        }
        $dir = str_replace('应用软件' , '{{APP}}' ,$param[3] );
        $this->addApp($name , $title , $dir , $type);
    }

}