<?
function __autoload($class_name){
	// Локальный инклуд
	$class_paths[] = dirname($_SERVER['SCRIPT_FILENAME'])."/inc/";
	// Общий инклуд
	$class_paths[] = dirname(__FILE__)."/";

	//добавим пути из глобальной переменной $CLASS_PATHS
	if(!empty($GLOBALS["CLASS_PATHS"])){
		if(!is_array($GLOBALS["CLASS_PATHS"])) throw new Exception('$CLASS_PATHS must be array!');
		$class_paths = array_merge($class_paths, $GLOBALS["CLASS_PATHS"]);
	}
	
	foreach($class_paths as $one){
		$file_path = $one."/{$class_name}.class.php";
		if(file_exists($file_path)){
			require_once($file_path);
			return;
		}
	}
}
?>