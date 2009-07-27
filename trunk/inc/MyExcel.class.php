<?
class MyExcel{
    static public function getCellSource($sheet, $cell){
        $src = Database::selectAndFetch("SELECT src FROM `myexcel` WHERE sheet='$sheet' AND x='".self::x($cell)."' AND y='".self::y($cell)."'");
        return $src;
    }
    
    static public function getCellValue($sheet, $cell){
        $src = self::getCellSource($sheet, $cell);
        return self::calculateValue($src);
    }
    
    //вычислить значение €чейки по исходному содержанию €чейки
    static public function calculateValue($src){
        if(!$src) return "";
        if($src[0] != '=') return $src;
        
        $formula = substr($src,1);
        return self::meval("return $formula;");
    }
    
    static public function setCellSource($sheet, $cell, $src){
        $src = addslashes($src);
        $x = self::x($cell);
        $y = self::y($cell);
        Database::query("REPLACE `myexcel`(sheet,x,y,src) VALUES('$sheet','$x', '$y', '$src')");
    }
    
    
    static public function meval($php){
        $old = error_reporting(0);
        return eval($php);
        error_reporting($old);
    }
    
    /**
    * возвращает букву колонки
    * 
    * @param mixed $cell
    */
    static public function x($cell){
        return preg_replace("/[^A-Z]/i", "", $cell);
    }

    /**
    * возвращает цифру строки
    * 
    * @param mixed $cell
    */
    static public function y($cell){
        return preg_replace("/\D/", "", $cell);
    }
    
    static public function  getLastSheets($count){
        Database::query("SELECT sheet FROM `myexcel` GROUP BY sheet LIMIT $count");
        $ret = array();
        while($row = Database::fetchRow()){
            $ret[] = $row['sheet'];
        }
        return $ret;
    }
}
?>