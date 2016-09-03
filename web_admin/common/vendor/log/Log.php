<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/17
 * Time: 14:19
 */

namespace common\vendor\log;

class Log {

    const FILE = '/log.log';


    /*
     * 读取日志
     */
    public static function get($line = 1000){
        $file = dirname(__file__).self::FILE;
        if( ! file_exists($file)){
            exit('log is empty');
        }
        $fp = fopen($file , 'r');
        /*
        if(flock($fp , LOCK_SH | LOCK_NB)){
            pr(fread($fp , $line),true);
            flock($fp , LOCK_UN);
        }
        fclose($fp);*/

        //echo "<pre>";
        $pos = -2;
        $eof = "";
        $str = "";
        while ($line > 0) {
            while ($eof != "\n") {
                if (!fseek($fp, $pos, SEEK_END)) {
                    $eof = fgetc($fp);
                    $pos--;
                } else {
                    break;
                }
            }
            $str .= fgets($fp);
            $eof = "";
            $line--;
        }
        return stripslashes($str);
    }

    /**
     * 清空日志
     */
    public static function clear(){
        file_put_contents(dirname(__file__).self::FILE, "");
       // unlink(dirname(__file__).self::FILE);
    }

    /**
     * 追加日志
     */
    public static function append($log){
        $fp = fopen(dirname(__file__).self::FILE , 'a');
        if(flock($fp , LOCK_EX)){
            fwrite($fp , json_encode($log)."\r\n");
            //fwrite($fp , self::getString($log)."/r/n");
            flock($fp , LOCK_UN);
        }
        fclose($fp);
    }

    /**
     * 获取变量的字符串值
     */
    private static function getString( $var ) {
        $template = php_sapi_name() !== 'cli' ? '<pre>%s</pre>' : "\n%s\n" ;
        printf( $template, print_r( $var, true ) ) ;
        exit;
    }

}

