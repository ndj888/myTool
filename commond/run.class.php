<?php
/**
 * Created by PhpStorm.
 * User: jiangjiacai
 * Date: 2015/9/30
 * Time: 12:07
 */

class runCom extends Commond{
    public function run(){
        $appName = $this->param[0];
        if ( !$this->appIsExist($appName)){
            echo $this->named.'���ҵ���������Ҫ��APP��������ָ������Һ���';
            return;
        }
        $this->db->where('name' , $appName , '=');
        $res = $this->db->get('myapp' , [0 , 1]);
        $dir = str_replace('{{APP}}' , 'Ӧ�����' ,$res[0]['path']);
        $comStr = 'start "" '.'"'.$dir.'"';
        $this->updateCtr($res[0]['id'] , $res[0]['runTime']);
        $this->runCmd($comStr);
    }

    /**
     * ���¼�����
     */
    public function updateCtr($id , $runTime){
        $this->db->where('id' , $id , '=');
        if ( !$this->db->update('myapp' , ['runTime' => $runTime += 1]) ) {
            echo $this->db->getLastError();
        }
    }
}