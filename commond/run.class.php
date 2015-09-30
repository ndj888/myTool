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
            echo $this->named.'我找到不到你需要的APP，请您用指令告诉我好吗？';
            return;
        }
        $this->db->where('name' , $appName , '=');
        $res = $this->db->get('myapp' , [0 , 1]);
        $dir = str_replace('{{APP}}' , '应用软件' ,$res[0]['path']);
        $comStr = 'start "" '.'"'.$dir.'"';
        $this->updateCtr($res[0]['id'] , $res[0]['runTime']);
        $this->runCmd($comStr);
    }

    /**
     * 更新计数器
     */
    public function updateCtr($id , $runTime){
        $this->db->where('id' , $id , '=');
        if ( !$this->db->update('myapp' , ['runTime' => $runTime += 1]) ) {
            echo $this->db->getLastError();
        }
    }
}