<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 14:07
 */
class searchCom extends Commond
{
    public function run(){
        $name = $this->param[0];
        $this->db->where('name' , $name , '=' , 'OR');
        $this->db->where('title' , $name , '=' , 'OR');
        $this->table($this->db->get('myapp'));
    }
}