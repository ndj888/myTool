<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/29
 * Time: 21:16
 */

require('Commond.class.php');
class Cli
{
    private $param; //参数列表

    public function __construct($argv){
        $this->param = $argv;
        $this->parse();
    }


    /**
     * 解析
     */
    private function parse(){
        if ( count($this->param) <= 1) {
            $this->showHelp();
            return;
        }
        $name = $this->param[0];
        $funName = $this->param[1];
        $param = [];
        for ( $i = 2; $i < count($this->param) ; $i ++ ){
            $param[] = $this->param[$i];
        }
        $file = COM.'/'.$funName.'.class'.'.php';
        if ( file_exists($file)){
            require($file);
        }else{
            $this->showHelp();
            return;
        }
        $class = $funName.'Com';
        $com = new $class($param);
        $com->run();
    }

    public function showHelp(){
        require(COM.'/'.'help.class.php');
        $com = new helpCom(NULL);
        $com->run();
    }
}