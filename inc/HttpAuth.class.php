<?

class HttpAuth{
	
	//массив пользователей перегружается в зависмости от контекста, необходимыми парами логин-пароль
	static public $users /*= array(
		'admin' => 'adminpass',
		'someone' => 'somepass'
		)*/;

	public $authorized = false;
	
	public function isAuthorized(){
		if(empty(self::$users)) return true;
		if(empty($_SERVER['PHP_AUTH_USER'])) return false;
		if(empty($_SERVER['PHP_AUTH_PW'])) return false;
		
		if(!array_key_exists ($_SERVER['PHP_AUTH_USER'], self::$users)) return false;
		if(self::$users[$_SERVER['PHP_AUTH_USER']] !== $_SERVER['PHP_AUTH_PW']) return false;
		return true;
	}

	public function authorize(){
		if(!$this->isAuthorized()){
			header('WWW-Authenticate: Basic realm="Dispatcher panel"');
			header('HTTP/1.0 401 Unauthorized');
			echo '<h1 style="color:red">Доступ закрыт!</h1>';
			exit;
		}
	}

	public function https(){
		if(strpos($_SERVER["HTTP_HOST"], ".ru") === false) return;
		if(empty($_SERVER["HTTP_SSL"]) || $_SERVER["HTTP_SSL"] != 'on'){
			$link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header("Location: $link");
			die("<a href='$link'>$link</a>");
		}
	}
}
?>