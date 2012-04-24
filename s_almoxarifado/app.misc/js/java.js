$(document).ready(function() {
    initDatepicker();
    initFlashes();
    initErrorFields();
    initChangeStatusDialog();
    initDeleteDialog();
});

function gE(ID){
	return document.getElementById(ID);
}

function gEs(tag){
	return dcocument.getElementByTagName(tag);
}

function ValidaForm(frm) {

	if (frm.senha_usuario.value == frm.senha2_usuario.value){
	return true;
	}else{
	alert('Senha diferentes!');
	return false;
	}
		
}

function initFlashes() {
    var flashes = $("#flashes");
    if (!flashes.length) {
        return;
    }
    setTimeout(function() {
        flashes.slideUp("slow");
    }, 2000);
}