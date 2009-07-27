<?

abstract class Controller{
    protected $sm;
    
	function __construct(){
        $this->sm = new Smarty();
	}

	public function _get($varname, $default_value = false, $strip_tags = true){
		if(isset($_GET[$varname])){
			$ret = $strip_tags ? strip_tags($_GET[$varname]) : $_GET[$varname];
			if($pattern && !preg_match($pattern, $ret)) throw new Exception ("Недопустимый формат аргумента $varname=".$_GET[$varname]);
            return $ret;
        }
		else
			return $default_value;
	}
    
    public function _getp($varname, $pattern = false){
        $ret = $this->_get($varname);
        if($pattern && !preg_match($pattern, $ret)) throw new Exception ("Недопустимый формат аргумента $varname");
        return $ret;
    }

	public function _post($varname, $default_value = false, $strip_tags = true){
		if(isset($_POST[$varname])){
            if($strip_tags) return strip_tags($_POST[$varname]);
			else return $_POST[$varname];
        }
		else
			return $default_value;
	}

    public function _postp($varname, $pattern = false){
        $ret = $this->_post($varname);
        if($pattern && !preg_match($pattern, $ret)) throw new Exception ("Недопустимый формат аргумента $varname");
        return $ret;
    }
    
    public function _post1251($varname, $default_value = false, $strip_tags = true){
        return iconv('utf-8', 'windows-1251', $this->_post($varname));
    }

	public function _request($varname, $default_value = false, $strip_tags = true){
		if(isset($_REQUEST[$varname])){
            if($strip_tags) return strip_tags($_REQUEST[$varname]);
			else return $_REQUEST[$varname];
        }
		else
			return $default_value;
	}


	function _bind(){
		$act = "";
		if($this->_get("Act")){
			$act = $this->_get("Act");
		}
		else
			$act = 'index';
		if($act && $act[0] === '_') die("forbidden method");
		if(method_exists($this, $act))
			$this->{$act}();
		else
			die("wrong act");
	}
}
?>