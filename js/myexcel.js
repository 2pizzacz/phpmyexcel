//��� ������� �� ������
function onCellClick(cellId){
    if($("input#"+cellId).attr("changed") == 1) return; //���� ��� �������������, ���� �����������

    saveAllEdited(); //��������� ��� �������� ��� �������������� ������
    
    editCell(cellId); //��������� ������ � ����� ��������������
}

//��������� ������ � ����� ��������������
function editCell(cellId){
    $("input#"+cellId).show(); //���������� ���� �����
    $("input#"+cellId).attr("changed", 1); //�������� ��� ��� "� ��������������"
    $("input#"+cellId).attr("size", $("input#"+cellId).val().length+50);
    $("input#"+cellId).focus(); //������ ����� � ���� �����
    
}

//�� ������� ������ � ���� ����� ������������� ������
function inputKeyPress(input, e){
    cellId = $(input).attr("id")
    
    if(e.keyCode==13){ // Enter
        saveCell(cellId);
    }                                   
    if(e.keyCode==27){ // ESC
        cancelChanges(cellId);
    }                                   
}

//��������� ���������� ������������� ������
function saveCell(cellId){
    $("input#"+cellId).hide();
    $("input#"+cellId).attr("changed", 0);

    //��������� ����� �������� ������, � ��������� ���������
    Short.postForm('form_'+cellId, "#"+cellId+"_value");
}

//�������� ��������� ������
function cancelChanges(cellId){
    $("input#"+cellId).hide();
    $("input#"+cellId).attr("changed", 0);
    $("div#"+cellId+"_value").show();
}


//��������� ��� ������, �������� ��� ��������������
function saveAllEdited(){
    $("input[changed=1]").each(function(i, e){
        var cellId = $(e).attr("id");
        saveCell(cellId);
    });
}