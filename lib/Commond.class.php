<?php

/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 10:17
 */

class Commond
{
    public $error; //������Ϣ
    public $db;
    public $param; //����̨����Ĳ���
    public $named = '���ˣ�';//�ƺ�

    public function __construct($param){
        $this->db = new MysqliDb('localhost' , 'root' , 'root' , 'my');
        $this->param = $param;
    }
    public $help = [
        '---lists                �鿴�������' ,
        '---lists type x         �鿴ĳ��������',
        '---search x             ����ĳ�����',
        '---addApp name          ���ĳ�������',
        '---delApp name          ɾ��ĳ�������',
        '---run x                ����ĳ�����'
    ];


    /**
     * ��ʾ����
     */
    public function help(){
        foreach($this->help as $k){
            echo ($k."\n");
        }
    }

    /**
     * ����cmd����
     * @param $com
     */
    public function runCmd($com){
        system($com);
    }

    /**
     * �Ա�����ʽ��ӡ����
     */
    public function table($d){
        if ( count($d) < 1 ){
            echo '��ʱû�����ݼ�¼��'.$this->named.'�����ʹ�� add��ӡ�';
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
     * Ӧ���Ƿ����
     */
    protected function appIsExist($name){
        $this->db->where('name' , $name , '=');
        $res = $this->db->get('myapp');
        return count($res) < 1 ? false : true;
    }

    /**
     * ���һ����Ӧ��
     * @param $name
     * @param $title
     * @param $dir
     * @param $type
     */
    protected function addApp($name , $title , $dir , $type){
        if ( !$this->appIsExist($name)){
            $result = $this->db->insert('myapp' , ['name' => $name , 'title' => $title , 'path' => $dir , 'addTime' => time() , 'type' => $type]);
            if ( $result ){
                echo $this->named.'�����Ӧ��'.$name.'�ɹ���'."\n";
            }else{
                echo $this->db->getLastError();
            }
        }else{
            echo $this->named.'���Ѿ���ӹ���Ӧ���ˣ�'."\n";
        }
    }

}