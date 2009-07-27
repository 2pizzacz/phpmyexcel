<?

class Database{
    static private $connection = null;
    static private $last_result = null;
	static public function connect(){
        if(!is_null(self::$connection)) return self::$connection;
		
		if(strpos ($_SERVER['HTTP_HOST'], '.ru'))
			$mysql = parse_ini_file(dirname(__FILE__)."/../mysql.ini");
		else
			$mysql = parse_ini_file(dirname(__FILE__)."/../mysql_local.ini");

		$r = mysql_connect($mysql['host'], $mysql['name'], $mysql['pass']);
		
		if (!$r) 
			throw new Exception("Невозможно соединиться с MySQL");

		if(!mysql_select_db($mysql['database']))
			throw new Exception(mysql_error());
            

		self::$connection = $r;
        return $r;
	}

	static public function query($sql)
	{
		self::$last_result = mysql_query($sql);
		$err = mysql_error();
		if ($err !== '')
		{
			echo "<table align='center' border=1>";
			echo "<tr><td align='center'><font color=red><b>ОШИБКА MYSQL!</b></font></td></tr>";
			echo "<tr><td>";
			echo "<b>$err</b><br>$sql";
			echo "</td></tr></table>";
			return false;
		}
		return self::$last_result;
	}
    
    static public function fetchRow(){
        if(!self::$last_result) return false;
        return mysql_fetch_assoc(self::$last_result);
    }
    
    static public function fetchAll(){
        $ret = array();
        while($row = self::fetchRow()) $ret[] = $row;
        return $ret;
    }
    
    static public function selectAndFetch($sql){
        self::query($sql);
        $row = self::fetchRow();
        if(empty($row)) return false;
        return reset($row);
    }
}
?>