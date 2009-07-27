<?

class HttpAuth{
	public $authorized = false;
	
	private $dispatchers = array(
		'admin' => 'admin',
		'someone' => 'somepass'
	);

	public function isAuthorized(){
		if(empty($_SERVER['PHP_AUTH_USER'])) return false;
		if(empty($_SERVER['PHP_AUTH_PW'])) return false;
		
		if(!array_key_exists ($_SERVER['PHP_AUTH_USER'], $this->dispatchers)) return false;
		if($this->dispatchers[$_SERVER['PHP_AUTH_USER']] !== $_SERVER['PHP_AUTH_PW']) return false;
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