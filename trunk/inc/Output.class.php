<?
class Output{
    public static $sm = null;
    private static $templates = array();
    
    static public function addTemplate($file_name){
        self::$templates[] = $file_name;
    }

    static public function setTemplate($file_name){
        self::$templates = null;
        self::$templates[] = $file_name;
    }
    
    static public function assign($varname, $value){
        self::$sm->assign($varname, $value);
    }
    
    static public function setContent($text){
        self::assign("content", $text);
    }
    
    
    static public function fetchAll(){
        $tpls = array_reverse(self::$templates);
        foreach($tpls as $one){
            $content = self::fetch($one);
            self::$sm->assign('content', $content);
        }
        return $content;
    }

    static public function fetch($resource_name){
        //$ret = "\n<!-- begin $resource_name -->\n";
        $ret = self::$sm->fetch($resource_name);
        //$ret .= "\n<!-- end $resource_name -->\n";
        return $ret;
    }
}

Output::$sm = new Smarty();
?>