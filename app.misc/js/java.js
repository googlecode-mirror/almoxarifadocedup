$(document).ready(function() {
    initDatepicker();
    initFlashes();
    initErrorFields();
    initDeleteDialog();
    zerar();
  
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

function clique(e){
	
	
	$(e).attr('class','linha');
	
	var key = $(".linha td").html();
	
	$("tr").each(function(i){
		if (i%2 == 0){
			$(this).attr('bgcolor', '#e0e0e0');
		}else{
			$(this).attr('bgcolor', '#ffffff');
		}
			$(this).removeClass('linha');

	});
	
	$('#menu').css("visibility","visible" );
	
	$("#a1").attr('href', 'index.php?modulo=usuarios&page=gerenciar&key='+key);
	$("#a2").attr('href', 'index.php?modulo=permissoes&page=gerenciar&key='+key);	
	$("#a3").attr('href', 'index.php?modulo=chaves&page=gerenciar&key='+key);	
	$("#a4").attr('href', 'index.php?modulo=emprestimos&page=gerar&key='+key);	

	
	$(e).attr('bgcolor','#E9967A');

}

function zerar(){

    $('#content').click(function(e){

        if (e.target == this){

            $('#menu').css("visibility","hidden" );
           
            $("#tableUsers tr").each(function(i){
		if (i%2 == 0){
			$(this).attr('bgcolor', '#e0e0e0');
		}else{
			$(this).attr('bgcolor', '#ffffff');
		}
			$(this).removeClass('linha');

            });
        }
    })


}


