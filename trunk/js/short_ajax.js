Short = function(){};
Short.loadData = function(url, receive_div_id){
	$("#"+receive_div_id).html('<img src="/images/loading.gif">');
	$.get(url, function(data){
		$("#"+receive_div_id).html(data);
	});
}

Short.postForm = function(formid, receive_element){
    $(receive_element).html('<img src="/images/loading.gif">');
    Short.postFormCallback(formid, function(res){
        $(receive_element).html(res);
    });
}

Short.postFormCallback = function(formid, clbk){
    if( typeof( $('#'+formid).formToArray ) == 'function' )
        data = $('#'+formid).formToArray();
    else if( typeof( $('#'+formid).serializeArray ) == 'function' )
        data = $('#'+formid).serializeArray();
    var src=$('#'+formid).attr('action');
    $.post( src + '&random=' + Math.random(), data, clbk);
}

Short.loadMessageBox = function(url){
    Short.showMessageBox("загрузка...");
    $.get(url, function(data){
    Short.showMessageBox(data);
    });
}

Short.showMessageBox = function(text){
    Short.hideMessageBox();
    boxContainer = document.createElement('div');
    boxContainer.className = 'popup_box_container';

    contentContainer = document.createElement('div');
    contentContainer.className = 'popup_box_content_container'
    contentContainer.innerHTML = text;       
    
    boxContainer.appendChild(contentContainer);
    
    closer = document.createElement('a');
    closer.className = "popup_box_closer";
    closer.href = "JavaScript:Short.hideMessageBox()";
    closer.innerHTML = "Закрыть";

    buttonsContainer = document.createElement('div');
    buttonsContainer.className = 'popup_box_buttons_container'
    buttonsContainer.appendChild(closer);

    boxContainer.appendChild(buttonsContainer);
    
    var height = window.innerHeight ? window.innerHeight : (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.offsetHeight);
    boxContainer.style.top = document.documentElement.scrollTop + (height - boxContainer.offsetHeight) / 3 + 'px';
    document.body.appendChild(boxContainer);
}

Short.hideMessageBox = function(){
    $('.popup_box_container').hide();
}




