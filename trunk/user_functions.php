<?
function sql($sql){
    return Database::selectAndFetch($sql);
}

function val($cell){
    return MyExcel::getCellValue(get_current_sheet(), $cell);
}
?>
