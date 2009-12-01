//при нажатии на €чейку
function onCellClick(cellId){
    if($("input#"+cellId).attr("changed") == 1) return; //если уже редактируетс€, клик игнориуетс€

    saveAllEdited(); //сохран€ем все открытые дл€ редактировани€ €чейки
    
    editCell(cellId); //переводим €чейку в режим редактировани€
}

//перевести €чейку в режим редактировани€
function editCell(cellId){
    $(".cellinput#"+cellId).show(); //показываем поле ввода
    $(".cellinput#"+cellId).attr("changed", 1); //помечаем его как "в редактировании"
    $(".cellinput#"+cellId).attr("size", $(".cellinput#"+cellId).val().length+50);
    $(".cellinput#"+cellId).focus(); //ставим фокус в поле ввода
    
}

//на нажатие клавиш в поле ввода редактируемой €чейки
function inputKeyPress(input, e){
    cellId = $(input).attr("id")
    
    if(e.keyCode==113){ // F2
        saveCell(cellId);
    }                                   
    if(e.keyCode==27){ // ESC
        cancelChanges(cellId);
    }                                   
}

//сохранить содержимое редактируемой €чейки
function saveCell(cellId){
    $(".cellinput#"+cellId).hide();
    $(".cellinput#"+cellId).attr("changed", 0);

    //сохран€ем новое значение €чейки, и загружаем результат
    Short.postForm('form_'+cellId, "#"+cellId+"_value");
}

//отменить изменени€ €чейки
function cancelChanges(cellId){
    $(".cellinput#"+cellId).hide();
    $(".cellinput#"+cellId).attr("changed", 0);
    $("div#"+cellId+"_value").show();
}


//сохранить все €чейки, открытые дл€ редактировани€
function saveAllEdited(){
    $(".cellinput[changed=1]").each(function(i, e){
        var cellId = $(e).attr("id");
        saveCell(cellId);
    });
}