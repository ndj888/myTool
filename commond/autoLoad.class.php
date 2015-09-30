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
        $dir = isset($param[0]) ? $param[0] : '';//文件夹路径
        if ( !$dir ){
            echo $this->named.'无效路径！';
            return;
        }
        $list = self::delSuffix(scandir($dir));
        if ( is_array($list)){
            foreach ( $list as $v){
                $this->addApp($v , $v , '' , 'other');
            }
            echo $this->named.'导入成功，本次导入'.count($list).'个！';
        }else{
            echo $this->named.'该路径下没有任何文件！';
        }
    }


    /**
     * 去除文件后缀
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
     * 是否是中文汉字
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