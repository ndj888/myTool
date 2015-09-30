<?php
/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 11:10
 */

class listsCom extends Commond{
    public function run(){
        $t = isset($this->param[0]) ? $this->param[0] : '';
        $type = isset($this->param[1]) ? $this->param[1]  : '';
        if ( $t == 'type'){
            $this->db->where('type' , $type , '=');
            $this->table($this->db->get('myapp' , null , ['id' , 'name' ,'title' , 'type']));
            return;
        }

        $this->table($this->db->get('myapp'));
    }
}