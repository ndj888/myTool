<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 17:42
 */
class autoLoadCom extends Commond
{
    public function run(){
        $param = $this->param;
        $dir = isset($param[0]) ? $param[0] : '';//�ļ���·��
        if ( !$dir ){
            echo $this->named.'��Ч·����';
            return;
        }
        $list = self::delSuffix(scandir($dir));
        if ( is_array($list)){
            foreach ( $list as $v){
                $this->addApp($v , $v , '' , 'other');
            }
            echo $this->named.'����ɹ������ε���'.count($list).'����';
        }else{
            echo $this->named.'��·����û���κ��ļ���';
        }
    }


    /**
     * ȥ���ļ���׺
     */
    private function delSuffix($list){
        $data = [];
        foreach ( $list as $v){
            if ( !self::isCN($v) ){
                $data[] = preg_replace('/\.(.*)/' , '' , $v);
            }
        }
        return $data;
    }

    /**
     * �Ƿ������ĺ���
     * @param $str
     */
    private function isCN($str){
        $pattern = '/[^\x00-\x80]/';
        if(preg_match($pattern,$str)){
            return true;
        }else{
            return false;
        }
    }
}