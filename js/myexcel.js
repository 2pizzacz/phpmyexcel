//��� ������� �� ������
function onCellClick(cellId){
    if($("input#"+cellId).attr("changed") == 1) return; //���� ��� �������������, ���� �����������

    saveAllEdited(); //��������� ��� �������� ��� �������������� ������
    
    editCell(cellId); //��������� ������ � ����� ��������������
}

//��������� ������ � ����� ��������������
function editCell(cellId){
    $(".cellinput#"+cellId).show(); //���������� ���� �����
    $(".cellinput#"+cellId).attr("changed", 1); //�������� ��� ��� "� ��������������"
    $(".cellinput#"+cellId).attr("size", $(".cellinput#"+cellId).val().length+50);
    $(".cellinput#"+cellId).focus(); //������ ����� � ���� �����
    
}

//�� ������� ������ � ���� ����� ������������� ������
function inputKeyPress(input, e){
    cellId = $(input).attr("id")
    
    if(e.keyCode==113){ // F2
        saveCell(cellId);
    }                                   
    if(e.keyCode==27){ // ESC
        cancelChanges(cellId);
    }                                   
}

//��������� ���������� ������������� ������
function saveCell(cellId){
    $(".cellinput#"+cellId).hide();
    $(".cellinput#"+cellId).attr("changed", 0);

    //��������� ����� �������� ������, � ��������� ���������
    Short.postForm('form_'+cellId, "#"+cellId+"_value");
}

//�������� ��������� ������
function cancelChanges(cellId){
    $(".cellinput#"+cellId).hide();
    $(".cellinput#"+cellId).attr("changed", 0);
    $("div#"+cellId+"_value").show();
}


//��������� ��� ������, �������� ��� ��������������
function saveAllEdited(){
    $(".cellinput[changed=1]").each(function(i, e){
        var cellId = $(e).attr("id");
        saveCell(cellId);
    });
}