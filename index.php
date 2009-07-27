<?
include(".setup.php");
include("user_functions.php");
$CURRENT_SHEET = "";

function get_current_sheet(){
    if(!empty($_REQUEST["sheet"]))
        return $_REQUEST["sheet"];
    return "main";
}

class CCC extends Controller{
    function index(){
        $sheet = get_current_sheet();
        $max_rows = $this->_get("rows", 10);
        $max_cols = $this->_get("cols", 5);
        
        
        echo '<head><title>phpMyExcel ������� '.get_current_sheet().'</title></head>';
        echo '<script src="'.Root::i()->getVar('wroot').'js/jquery-1.3.2.min.js"></script>';
        echo '<script src="'.Root::i()->getVar('wroot').'js/short_ajax.js"></script>';
        echo '<script src="'.Root::i()->getVar('wroot').'js/myexcel.js"></script>';
        echo '<LINK REL="stylesheet" HREF="'.Root::i()->getVar('wroot').'style.css" TYPE="text/css">';
        echo "<input type='hidden' name='sheet' value='$sheet'>";
        
        echo "<div class='toolbar'>";
        echo "<form method='GET'>";
            echo "�������: <input type='text' name='sheet' value='".get_current_sheet()."'>";
            echo " ��������: <input type='text' name='cols' value='$max_cols' size=2>";
            echo " �����: <input type='text' name='rows' value='$max_rows' size=2>";
            echo " <input type='submit' value='�������'>";
            foreach(MyExcel::getLastSheets(10) as $one){
                echo "&nbsp;<a style='font-size:10px' href='?sheet=$one'>$one</a>";
            }
        echo "</form>";
        echo "</div>";
        
        echo "<table id='excel'>";
        echo "<tr>";
            echo "<td colspan=100>&nbsp;</td>";
        echo "</tr>";
        
        echo "<tr>";
        echo "<th>&nbsp;</th>";
        for($col = 0; $col < $max_cols; $col++){
            echo "<th>".chr(0x41 + $col)."</th>";
        }
        echo "</tr>";
        
        for($row = 0; $row < $max_rows; $row++){
            echo "<tr>";
            echo "<th>".$row."</th>";
            for($col = 0; $col < $max_cols; $col++){
                $cellId = chr(0x41 + $col).$row; 
                echo "<td onclick='onCellClick(\"$cellId\")' width=100 class='cell'>";
                echo "<form id='form_{$cellId}' action='".Root::i()->getVar('wroot')."?Act=saveCell&sheet={$sheet}&cell_id={$cellId}' method='POST' onSubmit='return false;' style='margin:0; padding:0;'>";
                $input_source = preg_replace("/\"/", "&quot;", MyExcel::getCellSource($sheet, $cellId)); 
                echo "<input name='content' class='cellinput' title='$cellId' type='text' value=\"".$input_source."\" id='$cellId' onkeypress='inputKeyPress(this, event)'>";
                echo "</form>";
                echo "<div id='{$cellId}_value' style='min-height:20px;white-space: nowrap;'>".MyExcel::getCellValue($sheet, $cellId)."</div>";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    function saveCell(){
        $sheet = get_current_sheet();
        $cell_id = $this->_get("cell_id");
        $new_content = $this->_post("content");
        $new_content = stripslashes($new_content);
        $new_content = iconv('utf-8','windows-1251',$new_content);
        $new_content = trim($new_content);
        
        MyExcel::setCellSource($sheet, $cell_id, $new_content);
        echo MyExcel::getCellValue($sheet, $cell_id);
    }
}

$c = new CCC();
$c->_bind();


?>