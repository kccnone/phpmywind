<?php  
/** 
 *   文本中的非法字符过滤类  
 */  
class Filter{  
    private $pattern;
    private $replacement;
    /** 
     * 构造函数，进行初始化工作，加载替换规则，并构造用于模式查找和模式替换的两个数组 
     */  
    public function __construct(){
        $file = dirname(__FILE__).'/filter.txt';  
        $f= fopen($file,"r");  
        if(!$f){  
            die("open filter file failed!");  
        }  
        while (!feof($f))  
        {  
            $line = fgets($f);//从过滤规则文件中读取一行记录  
            $patternandreplace = explode('=', $line); //用等号分割，前面的用作模式串，后面的用作替换串
            if(count($patternandreplace)!=2){
                continue;
            }
            $this->pattern[] = '/'.$patternandreplace[0].'/';
            $this->replacement[] = trim($patternandreplace[1]);
        }  
        fclose($f);

        $file1 = dirname(__FILE__).'/filter1.txt';  
        $f1= fopen($file1,"r");  
        if(!$f1){  
            die("open filter file failed!");  
        }  
        while (!feof($f1))  
        {  
            $line1 = fgets($f1);//从过滤规则文件中读取一行记录
            $patternandreplace1 = explode('=', $line1); //用等号分割，前面的用作模式串，后面的用作替换串
            if(count($patternandreplace1)!=2){
                continue;
            }
            $this->pattern[] = '/'.$patternandreplace1[0].'/';
            $this->replacement[] = trim($patternandreplace1[1]);
        }  
        fclose($f1);    
    }  
    /** 
     * 去除$source中的敏感字符，用*替换 
     * @param unknown_type $source 
     */  
    public function clean($source){  
        return preg_replace($this->pattern,$this->replacement,$source);  
    }  
}