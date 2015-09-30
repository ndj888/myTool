<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 10:17
 */

class Commond
{
    public $error; //错误信息
    public $db;
    public $param; //控制台传入的参数
    public $named = '主人，';//称呼

    public function __construct($param){
        $this->db = new MysqliDb('localhost' , 'root' , 'root' , 'my');
        $this->param = $param;
    }
    public $help = [
        '---lists                查看所有软件' ,
        '---lists type x         查看某分类的软件',
        '---search x             搜索某个软件',
        '---addApp name          添加某个新软件',
        '---delApp name          删除某个新软件',
        '---run x                运行某个软件'
    ];


    /**
     * 显示帮助
     */
    public function help(){
        foreach($this->help as $k){
            echo ($k."\n");
        }
    }

    /**
     * 运行cmd命令
     * @param $com
     */
    public function runCmd($com){
        system($com);
    }

    /**
     * 以表格的形式打印数据
     */
    public function table($d){
        if ( count($d) < 1 ){
            echo '暂时没有数据记录，'.$this->named.'你可以使用 add添加。';
            return;
        }
        $keys = array_keys($d[0]);
        $header = '';
        $content = '';
        $i = 0;

        foreach ( $keys as $k){
            $header .= $k."\t";
        }
        foreach ( $d as $v){
            foreach ( $v as $k){
                if ( $i % count($keys) == 0){
                    $content .= "\n";
                }
                $content .= $k."\t";
                $i ++;
            }
        }

        echo $header."\n";
        echo $content;
    }

    /**
     * 应用是否存在
     */
    protected function appIsExist($name){
        $this->db->where('name' , $name , '=');
        $res = $this->db->get('myapp');
        return count($res) < 1 ? false : true;
    }

    /**
     * 添加一个新应用
     * @param $name
     * @param $title
     * @param $dir
     * @param $type
     */
    protected function addApp($name , $title , $dir , $type){
        if ( !$this->appIsExist($name)){
            $result = $this->db->insert('myapp' , ['name' => $name , 'title' => $title , 'path' => $dir , 'addTime' => time() , 'type' => $type]);
            if ( $result ){
                echo $this->named.'添加新应用'.$name.'成功！'."\n";
            }else{
                echo $this->db->getLastError();
            }
        }else{
            echo $this->named.'您已经添加过该应用了！'."\n";
        }
    }

}